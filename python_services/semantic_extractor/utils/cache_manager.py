"""
File-based Cache Manager — Disk-cached JSON results with TTL.

Uses the filesystem for caching extracted keyword data to avoid
re-hitting APIs for the same tool. Each cache entry is a JSON file
keyed by a hash of the query + source + language.
"""

import hashlib
import json
import time
from pathlib import Path
from config import config


class CacheManager:
    """
    Filesystem-backed cache with TTL expiration.

    Cache directory structure:
        .cache/
          google_suggest/
            <hash>.json
          paa/
            <hash>.json
    """

    def __init__(self, cache_dir: str | None = None, ttl_hours: int | None = None):
        self._cache_dir = Path(cache_dir or config.CACHE_DIR)
        self._ttl_seconds = (ttl_hours or config.CACHE_TTL_HOURS) * 3600
        self._cache_dir.mkdir(parents=True, exist_ok=True)
        self._hits = 0
        self._misses = 0

    def _make_key(self, source: str, query: str, language: str = 'en') -> str:
        """Generate a deterministic cache key hash."""
        raw = f"{source}:{query}:{language}"
        return hashlib.sha256(raw.encode()).hexdigest()[:16]

    def _source_dir(self, source: str) -> Path:
        """Get or create the source-specific cache subdirectory."""
        d = self._cache_dir / source
        d.mkdir(parents=True, exist_ok=True)
        return d

    def get(self, source: str, query: str, language: str = 'en') -> list | dict | None:
        """
        Retrieve cached data if it exists and hasn't expired.

        Returns None on miss or expiration.
        """
        key = self._make_key(source, query, language)
        cache_file = self._source_dir(source) / f"{key}.json"

        if not cache_file.exists():
            self._misses += 1
            return None

        try:
            data = json.loads(cache_file.read_text(encoding='utf-8'))
            stored_at = data.get('_stored_at', 0)

            # Check TTL
            if (time.time() - stored_at) > self._ttl_seconds:
                cache_file.unlink(missing_ok=True)
                self._misses += 1
                return None

            self._hits += 1
            return data.get('payload')
        except (json.JSONDecodeError, KeyError):
            cache_file.unlink(missing_ok=True)
            self._misses += 1
            return None

    def set(self, source: str, query: str, payload: list | dict, language: str = 'en') -> None:
        """Store data in the cache with a timestamp."""
        key = self._make_key(source, query, language)
        cache_file = self._source_dir(source) / f"{key}.json"

        data = {
            '_stored_at': time.time(),
            '_source': source,
            '_query': query,
            '_language': language,
            'payload': payload,
        }

        cache_file.write_text(json.dumps(data, ensure_ascii=False), encoding='utf-8')

    def clear(self, source: str | None = None) -> int:
        """
        Clear all cache entries or entries for a specific source.
        Returns the number of files deleted.
        """
        count = 0
        if source:
            source_dir = self._source_dir(source)
            for f in source_dir.glob('*.json'):
                f.unlink()
                count += 1
        else:
            for f in self._cache_dir.rglob('*.json'):
                f.unlink()
                count += 1
        return count

    def get_stats(self) -> dict:
        """Return cache statistics."""
        total_files = len(list(self._cache_dir.rglob('*.json')))
        total_size_kb = sum(
            f.stat().st_size for f in self._cache_dir.rglob('*.json')
        ) / 1024

        return {
            'total_entries': total_files,
            'total_size_kb': round(total_size_kb, 1),
            'hits': self._hits,
            'misses': self._misses,
            'hit_rate': round(
                self._hits / max(1, self._hits + self._misses) * 100, 1
            ),
        }


# Global singleton
cache_manager = CacheManager()
