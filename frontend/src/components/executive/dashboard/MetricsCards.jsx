import React from "react";
import { DollarSign, TrendingUp, Users, FileText } from "lucide-react";

const ExecutiveDashboardMetricsCards = () => {
  return (
    <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
      {Data.map((kpi, index) => (
        <div
          key={index}
          className="bg-white/50 shadow rounded-md p-4 flex items-center justify-between"
        >
          <div className="flex items-center">
            <div className="space-y-2">
              <h3 className="text-lg font-semibold">{kpi.title}</h3>
              <p className="text-gray-500">{kpi.value}</p>
              <div
                className={`text-sm font-medium ${
                  kpi.changeType === "positive"
                    ? "text-green-500"
                    : "text-red-500"
                }`}
              >
                {kpi.change}
              </div>
            </div>
          </div>

         <p className="text-orange-500 bg-orange-100 p-3 rounded-md">{kpi.icon}</p>
        </div>
      ))}
    </div>
  );
};

export default ExecutiveDashboardMetricsCards;

const Data = [
  {
    title: "Total Collections",
    value: "GHS 125.6M",
    change: "+12.5%",
    changeType: "positive",
    icon: <DollarSign className="w-6 h-6" />,
  },
  {
    title: "Monthly Growth",
    value: "8.2%",
    change: "+2.1%",
    changeType: "positive",
    icon: <TrendingUp className="w-6 h-6" />,
  },
  {
    title: "Active Taxpayers",
    value: "45,892",
    change: "+1,248",
    changeType: "positive",
    icon: <Users className="w-6 h-6" />,
  },
  {
    title: "Pending Returns",
    value: "2,156",
    change: "-342",
    changeType: "negative",
    icon: <FileText className="w-6 h-6" />,
  },
];
