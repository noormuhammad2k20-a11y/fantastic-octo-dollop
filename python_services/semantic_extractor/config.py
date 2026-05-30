"""
Configuration — Environment-driven settings for the semantic extractor.

Reads from .env file or environment variables. All values have safe defaults
so the service can run in development without any configuration.
"""

import os
from pathlib import Path
from dotenv import load_dotenv

# Load .env from the project root (ToolsHub/)
_env_path = Path(__file__).resolve().parent.parent.parent / '.env'
load_dotenv(_env_path)


class Config:
    """Centralized configuration for the semantic extractor service."""

    # ─── Server ───────────────────────────────────────────────────
    HOST: str = os.getenv('EXTRACTOR_HOST', '127.0.0.1')
    PORT: int = int(os.getenv('EXTRACTOR_PORT', '8100'))
    DEBUG: bool = os.getenv('EXTRACTOR_DEBUG', 'true').lower() == 'true'

    # ─── Laravel Integration ──────────────────────────────────────
    LARAVEL_APP_URL: str = os.getenv('APP_URL', 'http://localhost/ToolsHub')
    SHARED_SECRET: str = os.getenv('EXTRACTOR_SECRET', 'dev-secret-change-in-production')

    # ─── External Services ────────────────────────────────────────
    OPENAI_API_KEY: str | None = os.getenv('OPENAI_API_KEY')

    # ─── Rate Limiting ────────────────────────────────────────────
    # Google Suggest: max requests per minute
    GOOGLE_SUGGEST_RPM: int = int(os.getenv('GOOGLE_SUGGEST_RPM', '30'))
    # Pause between requests (seconds)
    GOOGLE_SUGGEST_DELAY: float = float(os.getenv('GOOGLE_SUGGEST_DELAY', '2.0'))
    # PAA extraction delay
    PAA_DELAY: float = float(os.getenv('PAA_DELAY', '3.0'))

    # ─── User Agent Rotation ─────────────────────────────────────
    USER_AGENTS: list[str] = [
        'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36',
        'Mozilla/5.0 (Macintosh; Intel Mac OS X 14_5) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/17.5 Safari/605.1.15',
        'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:126.0) Gecko/20100101 Firefox/126.0',
        'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36',
        'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36 Edg/124.0.0.0',
    ]

    # ─── Cache ────────────────────────────────────────────────────
    CACHE_DIR: str = os.getenv(
        'EXTRACTOR_CACHE_DIR',
        str(Path(__file__).resolve().parent / '.cache')
    )
    CACHE_TTL_HOURS: int = int(os.getenv('EXTRACTOR_CACHE_TTL_HOURS', '24'))

    # ─── Language Support ─────────────────────────────────────────
    DEFAULT_LANGUAGE: str = 'en'
    SUPPORTED_LANGUAGES: list[str] = [
        'en', 'es', 'fr', 'de', 'pt', 'it', 'nl', 'ru',
        'ja', 'ko', 'zh', 'ar', 'hi', 'tr', 'id',
    ]

    # ─── Extraction Limits ────────────────────────────────────────
    MAX_SUGGESTIONS_PER_SEED: int = int(os.getenv('MAX_SUGGESTIONS', '50'))
    MAX_PAA_QUESTIONS: int = int(os.getenv('MAX_PAA_QUESTIONS', '10'))
    BATCH_SIZE: int = int(os.getenv('EXTRACTOR_BATCH_SIZE', '5'))


config = Config()
