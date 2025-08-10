import React from "react";
import { FiAward, FiTrendingUp, FiUsers, FiDollarSign } from "react-icons/fi";

const achievements = [
  {
    title: "Top Performer",
    desc: "Highest collections this quarter",
    icon: <FiAward className="text-green-600" />,
    color: "bg-green-100 text-green-700",
  },
  {
    title: "Quick Resolver",
    desc: "Fastest case resolution time",
    icon: <FiTrendingUp className="text-blue-600" />,
    color: "bg-blue-100 text-blue-700",
  },
  {
    title: "Team Player",
    desc: "Excellent collaboration score",
    icon: <FiUsers className="text-gray-500" />,
    color: "bg-gray-100 text-gray-700",
  },
  {
    title: "Monthly Target",
    desc: "Achieved 100% monthly target",
    icon: <FiDollarSign className="text-green-600" />,
    color: "bg-green-100 text-green-700",
  },
];

export default function Achievements() {
  return (
    <div className="bg-white rounded-md shadow p-5 border border-gray-100">
      <h3 className="font-semibold text-lg mb-4 text-gray-800">Achievements</h3>
      <div className="space-y-3">
        {achievements.map((ach, idx) => (
          <div key={idx} className={`flex items-center gap-3 px-3 py-2 rounded-lg ${ach.color}`}>
            {ach.icon}
            <div>
              <div className="font-semibold">{ach.title}</div>
              <div className="text-xs">{ach.desc}</div>
            </div>
          </div>
        ))}
      </div>
    </div>
  );
}
