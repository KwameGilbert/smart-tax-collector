import React, { useEffect, useState } from "react";
import axios from "axios";
import "remixicon/fonts/remixicon.css";

const iconMap = {
  "Total Revenue": {
    icon: "ri-money-dollar-circle-line",
    iconColor: "text-green-500",
    bgColor: "bg-green-100",
  },
  "Confirmed Payments": {
    icon: "ri-check-double-line",
    iconColor: "text-blue-500",
    bgColor: "bg-blue-100",
  },
  "Pending Payments": {
    icon: "ri-time-line",
    iconColor: "text-yellow-500",
    bgColor: "bg-yellow-100",
  },
  "Cancelled Payments": {
    icon: "ri-close-circle-line",
    iconColor: "text-red-500",
    bgColor: "bg-red-100",
  },
};

const PaymentsMetricsCards = () => {
  const [stats, setStats] = useState([]);
  

  useEffect(() => {
    axios
      .get("/assets/data/paymentsmetricsCards.json")
      .then((res) => setStats(res.data))
      .catch((err) => console.error("Failed to load stats:", err));
  }, []);

  return (
    <div className="grid grid-cols-1 md:grid-cols-4 gap-4">
      {stats.map((stat, index) => {
        const { icon, iconColor, bgColor } = iconMap[stat.label] || {};
        return (
          <div
            key={index}
            className="bg-white rounded shadow p-4 relative overflow-hidden"
          >
            <div
              className={`absolute top-3 right-3 text-xl ${iconColor} ${bgColor} rounded-full p-2`}
            >
              <i className={icon}></i>
            </div>
            <p className="text-sm text-gray-500 mb-5">{stat.label}</p>
            <p className="text-2xl font-bold mt-1">{stat.value}</p>
          </div>
        );
      })}
    </div>
  );
};

export default PaymentsMetricsCards;
