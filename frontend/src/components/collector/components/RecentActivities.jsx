import React from "react";
import { FiDollarSign, FiCalendar, FiCheckCircle, FiClock } from "react-icons/fi";

const activities = [
  {
    company: "Techno Corp Ltd.",
    type: "Collection",
    icon: <FiDollarSign className="text-green-600" />,
    amount: "$12,450",
    status: "completed",
    statusColor: "bg-green-100 text-green-700",
    time: "2 hours ago",
  },
  {
    company: "Green Solutions Inc.",
    type: "Meeting",
    icon: <FiCalendar className="text-blue-600" />,
    amount: "$8,750",
    status: "scheduled",
    statusColor: "bg-blue-100 text-blue-700",
    time: "4 hours ago",
  },
  {
    company: "Digital Dynamics",
    type: "Collection",
    icon: <FiDollarSign className="text-green-600" />,
    amount: "$25,300",
    status: "completed",
    statusColor: "bg-green-100 text-green-700",
    time: "6 hours ago",
  },
  {
    company: "Metro Services",
    type: "Followup",
    icon: <FiClock className="text-yellow-500" />,
    amount: "$5,600",
    status: "pending",
    statusColor: "bg-yellow-100 text-yellow-700",
    time: "1 day ago",
  },
];

export default function RecentActivities() {
  return (
    <div className="bg-white rounded-md h-full shadow p-5 border border-gray-100">
      <h3 className="font-semibold text-lg mb-4 text-gray-800">Recent Activities</h3>
      <div className="space-y-4">
        {activities.map((act, idx) => (
          <div key={idx} className="flex items-center gap-4">
            <div className="w-10 h-10 flex items-center justify-center rounded-full bg-gray-50">
              {act.icon}
            </div>
            <div className="flex-1">
              <div className="font-semibold text-gray-700">{act.company}</div>
              <div className="text-xs text-gray-500">{act.type}</div>
            </div>
            <div className="font-semibold text-gray-900">{act.amount}</div>
            <span className={`px-3 py-1 rounded-full text-xs font-bold ${act.statusColor}`}>{act.status}</span>
            <span className="text-xs text-gray-400">{act.time}</span>
          </div>
        ))}
      </div>
    </div>
  );
}
