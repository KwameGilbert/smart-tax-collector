import React from "react";
import { Target, TrendingUp, Users, Calendar } from "lucide-react";

const stats = [
  {
    title: "Collection Rate",
    value: "94.2%",
    change: "+2.1%",
    positive: true,
    icon: <Target className="w-5 h-5 text-orange-600" />,
  },
  {
    title: "Growth Rate",
    value: "12.8%",
    change: "+1.5%",
    positive: true,
    icon: <TrendingUp className="w-5 h-5 text-orange-600" />,
  },
  {
    title: "Active Taxpayers",
    value: "45,892",
    change: "+1,248",
    positive: true,
    icon: <Users className="w-5 h-5 text-orange-600" />,
  },
  {
    title: "Avg. Processing Time",
    value: "2.4",
    unit: "days",
    change: "-0.3 days",
    positive: true,
    icon: <Calendar className="w-5 h-5 text-orange-600" />,
  },
];

const StatsCards = () => {
  return (
    <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
      {stats.map((stat, index) => (
        <div
          key={index}
          className="p-4 bg-white rounded-md shadow-sm flex justify-between items-center"
        >
          <div>
            <p className="text-sm text-gray-500">{stat.title}</p>
            <div className="flex items-end gap-2">
              <h3 className="text-2xl font-bold">{stat.value}</h3>
              {stat.unit && <span className="text-sm text-gray-600">{stat.unit}</span>}
            </div>
            <p
              className={`text-sm mt-1 ${
                stat.positive ? "text-green-600" : "text-red-500"
              }`}
            >
              ↑ {stat.change}
            </p>
          </div>
          <div className="p-3 rounded-xl bg-orange-50">{stat.icon}</div>
        </div>
      ))}
    </div>
  );
};

export default StatsCards;
