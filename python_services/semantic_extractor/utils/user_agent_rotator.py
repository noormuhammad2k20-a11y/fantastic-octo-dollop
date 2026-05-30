"""
User Agent Rotator — Rotates through a pool of realistic user agents.

Prevents fingerprinting by cycling through different browser signatures.
"""

import random
from config import config


class UserAgentRotator:
    """
    Stateful user agent rotator that avoids repeating the same agent
    consecutively and tracks usage for diagnostics.
    """

    def __init__(self, agents: list[str] | None = None):
        self._agents = agents or config.USER_AGENTS
        self._last_used: str | None = None
        self._usage_count: dict[str, int] = {ua: 0 for ua in self._agents}

    def get(self) -> str:
        """
        Get the next user agent, avoiding the last-used one.
        """
        if len(self._agents) <= 1:
            return self._agents[0]

        available = [ua for ua in self._agents if ua != self._last_used]
        chosen = random.choice(available)
        self._last_used = chosen
        self._usage_count[chosen] = self._usage_count.get(chosen, 0) + 1
        return chosen

    def get_headers(self, extra: dict | None = None) -> dict:
        """
        Get a full set of realistic HTTP headers with a rotated user agent.
        """
        headers = {
            'User-Agent': self.get(),
            'Accept': 'text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
            'Accept-Language': 'en-US,en;q=0.9',
            'Accept-Encoding': 'gzip, deflate',
            'Connection': 'keep-alive',
            'Upgrade-Insecure-Requests': '1',
            'Cache-Control': 'max-age=0',
        }
        if extra:
            headers.update(extra)
        return headers

    def get_stats(self) -> dict:
        """Return usage statistics."""
        return {
            'total_agents': len(self._agents),
            'usage_distribution': dict(self._usage_count),
        }


# Global singleton
ua_rotator = UserAgentRotator()
