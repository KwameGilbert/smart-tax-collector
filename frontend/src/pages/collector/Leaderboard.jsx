import React from "react";
import {
  LeaderboardStats,
  PerformanceRankings,
  UpcomingRewards,
} from "../../components/collector/leaderboard/LeaderboardComponents";

export default function Leaderboard() {
  return (
    <div className="min-h-screen bg-gray-50 p-6">
      <div className="max-w-7xl mx-auto">
        <h2 className="text-2xl font-bold mb-2 text-gray-800">
          Team Leaderboard
        </h2>
        <p className="text-sm text-gray-500 mb-4">
          Track team performance and compete with colleagues
        </p>
        <LeaderboardStats />
        <div className="grid grid-cols-1 md:grid-cols-2 gap-6 mt-2">
          <PerformanceRankings />
          <UpcomingRewards />
        </div>
      </div>
    </div>
  );
}
