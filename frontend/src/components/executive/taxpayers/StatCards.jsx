import React from "react";
import { Users, UserCheck, UserPlus, UserX } from "lucide-react";

const stats = [
  {
    id: 1,
    title: "Total Taxpayers",
    value: "45,892",
    change: "+1,248",
    icon: <Users className="w-6 h-6 text-orange-500" />,
    trend: "up",
  },
  {
    id: 2,
    title: "Active This Month",
    value: "38,445",
    change: "+892",
    icon: <UserCheck className="w-6 h-6 text-orange-500" />,
    trend: "up",
  },
  {
    id: 3,
    title: "New Registrations",
    value: "1,248",
    change: "+156",
    icon: <UserPlus className="w-6 h-6 text-orange-500" />,
    trend: "up",
  },
  {
    id: 4,
    title: "Non-Compliant",
    value: "2,156",
    change: "-342",
    icon: <UserX className="w-6 h-6 text-orange-500" />,
    trend: "down",
  },
];

export default function TaxpayersDashboardStats() {
  return (
    <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 py-6">
      {stats.map((item) => (
        <div
          key={item.id}
          className="flex items-center justify-between bg-white shadow-sm rounded-md p-4 border border-gray-100"
        >
          <div>
            <p className="text-sm text-gray-500">{item.title}</p>
            <h2 className="text-2xl font-bold text-gray-800">{item.value}</h2>
            <p
              className={`text-sm font-medium ${
                item.trend === "up" ? "text-green-600" : "text-red-600"
              }`}
            >
              {item.change}
            </p>
          </div>
          <div className="p-3 rounded-xl bg-orange-50">{item.icon}</div>
        </div>
      ))}
    </div>
  );
}
