import React from "react";
// Removed duplicate import of BarChart and related recharts components

const stats = [
  { label: "Total Team Collections", value: "$3.2M", change: "+18.5%" },
  { label: "Average Efficiency", value: "93.1%", change: "+2.3%" },
  { label: "Cases Closed", value: "1,247", change: "+11.2%" },
  { label: "Team Size", value: "12", change: "+4%" },
];

const rankings = [
  { name: "Sarah Johnson", initials: "SJ", cases: 198, efficiency: "98.8%", amount: "$642,850", change: "+12.5%", color: "bg-green-500" },
  { name: "Michael Chen", initials: "MC", cases: 176, efficiency: "95.1%", amount: "$587,430", change: "+11.8%", color: "bg-yellow-400" },
  { name: "John Smith", initials: "JS", cases: 156, efficiency: "94.2%", amount: "$487,350", change: "+10.2%", color: "bg-gray-300", you: true },
  { name: "Emma Davis", initials: "ED", cases: 142, efficiency: "92.1%", amount: "$456,720", change: "+9.1%", color: "bg-gray-300" },
  { name: "Robert Wilson", initials: "RW", cases: 134, efficiency: "91.7%", amount: "$423,890", change: "+8.5%", color: "bg-yellow-400" },
];

const rewards = [
  { label: "Quarterly Bonus", value: "$3,200", progress: 85, color: "bg-orange-500" },
  { label: "Team Lead Promotion", value: "Position", progress: 67, color: "bg-purple-500" },
  { label: "Excellence Award", value: "$1,200", progress: 99, color: "bg-blue-500" },
];

// const trendData = [
//   { name: "Jan", value: 320 },
//   { name: "Feb", value: 400 },
//   { name: "Mar", value: 380 },
//   { name: "Apr", value: 420 },
//   { name: "May", value: 390 },
//   { name: "Jun", value: 450 },
// ];

export function LeaderboardStats() {
  return (
    <div className="grid grid-cols-1 md:grid-cols-4 gap-4 mb-4">
      {stats.map((stat, idx) => (
        <div key={idx} className="bg-white rounded-lg shadow p-4 border border-green-200 flex flex-col justify-between">
          <div className="text-xs text-gray-500 mb-1">{stat.label}</div>
          <div className="text-2xl font-bold text-gray-800">{stat.value}</div>
          <div className="text-xs text-green-600 mt-2">{stat.change}</div>
        </div>
      ))}
    </div>
  );
}




export function PerformanceRankings() {
  return (
    <div className="bg-white rounded-lg shadow p-4 border border-gray-100 mb-4">
      <div className="flex items-center gap-2 mb-4">
        <span className="ri-trophy-line text-yellow-500 text-xl" />
        <span className="font-semibold text-lg">Performance Rankings</span>
        <span className="text-xs text-gray-500 ml-2">Current quarter performance standings</span>
      </div>
      <div className="space-y-2">
        {rankings.map((r) => (
          <div key={r.name} className={`flex items-center justify-between rounded-lg px-4 py-3 ${r.you ? 'bg-green-50 border border-green-200' : 'hover:bg-gray-50'} transition-all`}>
            <div className="flex items-center gap-3">
              <div className={`w-10 h-10 rounded-full flex items-center justify-center font-bold text-white text-lg ${r.color}`}>{r.initials}</div>
              <div>
                <div className="font-semibold text-gray-800">{r.name} {r.you && <span className="text-xs bg-green-100 text-green-700 px-2 py-0.5 rounded ml-1">You</span>}</div>
                <div className="text-xs text-gray-500">{r.cases} cases • {r.efficiency} efficiency</div>
              </div>
            </div>
            <div className="flex flex-col items-end">
              <div className="font-semibold text-green-700">{r.amount}</div>
              <div className="text-xs text-green-500">{r.change}</div>
            </div>
          </div>
        ))}
      </div>
    </div>
  );
}

export function UpcomingRewards() {
  return (
    <div className="bg-white rounded-lg shadow p-4 border border-gray-100">
      <div className="flex items-center gap-2 mb-4">
        <span className="ri-star-line text-orange-400 text-xl" />
        <span className="font-semibold text-lg">Upcoming Rewards</span>
        <span className="text-xs text-gray-500 ml-2">Incentives and achievements to unlock</span>
      </div>
      <div className="space-y-4">
        {rewards.map((r) => (
          <div key={r.label} className="mb-2">
            <div className="flex justify-between items-center mb-1">
              <span className="font-medium text-gray-700">{r.label}</span>
              <span className="text-xs text-gray-500">{r.value}</span>
            </div>
            <div className="w-full h-2 rounded-full bg-gray-100 overflow-hidden">
              <div className={`h-2 rounded-full ${r.color}`} style={{ width: `${r.progress}%` }}></div>
            </div>
            <div className="text-xs text-gray-400 mt-1">Progress</div>
          </div>
        ))}
      </div>
    </div>
  );
}
