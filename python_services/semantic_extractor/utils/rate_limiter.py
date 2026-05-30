"""
Rate Limiter — Token bucket rate limiter for API calls.

Prevents hitting Google's rate limits by enforcing per-source
request quotas with configurable RPM and delays.
"""

import asyncio
import time
from collections import defaultdict


class RateLimiter:
    """
    Token-bucket rate limiter with per-source tracking.

    Usage:
        limiter = RateLimiter()
        await limiter.acquire('google_suggest', rpm=30, delay=2.0)
        # ... make request ...
    """

    def __init__(self):
        self._last_request: dict[str, float] = defaultdict(float)
        self._request_counts: dict[str, list[float]] = defaultdict(list)
        self._lock = asyncio.Lock()

    async def acquire(self, source: str, rpm: int = 30, delay: float = 1.0) -> None:
        """
        Wait until it's safe to make a request for the given source.

        Args:
            source: Identifier for the API source (e.g., 'google_suggest')
            rpm: Maximum requests per minute for this source
            delay: Minimum seconds between consecutive requests
        """
        async with self._lock:
            now = time.monotonic()

            # 1. Enforce minimum delay between requests
            elapsed = now - self._last_request[source]
            if elapsed < delay:
                wait_time = delay - elapsed
                await asyncio.sleep(wait_time)

            # 2. Enforce RPM limit (sliding window)
            window_start = time.monotonic() - 60.0
            self._request_counts[source] = [
                t for t in self._request_counts[source] if t > window_start
            ]

            if len(self._request_counts[source]) >= rpm:
                # Wait until the oldest request falls out of the window
                oldest = self._request_counts[source][0]
                wait_time = 60.0 - (time.monotonic() - oldest) + 0.1
                if wait_time > 0:
                    await asyncio.sleep(wait_time)

            # Record this request
            self._last_request[source] = time.monotonic()
            self._request_counts[source].append(time.monotonic())

    def get_stats(self) -> dict:
        """Return current rate limiter statistics."""
        now = time.monotonic()
        stats = {}
        for source in self._request_counts:
            window_start = now - 60.0
            active = [t for t in self._request_counts[source] if t > window_start]
            stats[source] = {
                'requests_last_minute': len(active),
                'last_request_ago_seconds': round(now - self._last_request[source], 1),
            }
        return stats


# Global singleton
rate_limiter = RateLimiter()
