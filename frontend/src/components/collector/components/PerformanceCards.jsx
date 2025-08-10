import React from "react";
import { FiDollarSign, FiUserCheck, FiTrendingUp, FiClock } from "react-icons/fi";

const cards = [
  {
    title: "Total Collections",
    value: "$487,350",
    subtitle: "This month",
    change: "+12.3%",
    target: "$500,000",
    percent: 97.5,
    icon: <FiDollarSign className="text-green-600" />,
    barColor: "bg-green-500",
    changeColor: "bg-green-100 text-green-700",
  },
  {
    title: "Cases Resolved",
    value: "156",
    subtitle: "This month",
    change: "+8.2%",
    target: "180",
    percent: 86.7,
    icon: <FiUserCheck className="text-blue-600" />,
    barColor: "bg-blue-500",
    changeColor: "bg-blue-100 text-blue-700",
  },
  {
    title: "Efficiency Rate",
    value: "94.2%",
    subtitle: "Performance score",
    change: "+2.3%",
    target: "95%",
    percent: 94.2,
    icon: <FiTrendingUp className="text-purple-600" />,
    barColor: "bg-purple-500",
    changeColor: "bg-purple-100 text-purple-700",
  },
  {
    title: "Response Time",
    value: "2.4hrs",
    subtitle: "Average",
    change: "-15%",
    target: "2hrs",
    percent: 80,
    icon: <FiClock className="text-orange-500" />,
    barColor: "bg-orange-500",
    changeColor: "bg-orange-100 text-orange-700",
  },
];

export default function PerformanceCards() {
  return (
    <div className="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
      {cards.map((card, idx) => (
        <div key={idx} className="bg-white rounded-md shadow p-5 flex flex-col gap-2 border border-gray-100">
          <div className="flex items-center gap-2 mb-1">
            {card.icon}
            <span className="font-semibold text-gray-700">{card.title}</span>
          </div>
          <div className="text-xl font-bold text-gray-900">{card.value}</div>
          <div className="flex items-center gap-2 text-sm">
            <span className="text-gray-500">{card.subtitle}</span>
            <span className={`px-2 py-1 rounded-full text-xs font-bold ${card.changeColor}`}>{card.change}</span>
          </div>
          <div className="flex items-center gap-2 text-xs mt-2">
            <span className="text-gray-400">Target: {card.target}</span>
            <span className="font-semibold text-gray-500">{card.percent}%</span>
          </div>
          <div className="w-full h-2 bg-gray-100 rounded-full mt-1">
            <div className={`${card.barColor} h-2 rounded-full`} style={{ width: `${card.percent}%` }} />
          </div>
        </div>
      ))}
    </div>
  );
}
