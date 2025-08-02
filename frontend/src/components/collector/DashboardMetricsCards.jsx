import React, { useEffect, useState } from "react";
import axios from "axios";
import { Progress } from "@/components/ui/progress";
import {
  CircleDollarSign,
  ClipboardList,
  Building2,
} from "lucide-react";

// Presentation logic (based on index)
const iconConfig = [
  {
    icon: CircleDollarSign,
    iconColor: "text-green-600",
    iconBg: "bg-green-100",
    progressBar: "bg-green-600",
  },
  {
    icon: ClipboardList,
    iconColor: "text-blue-600",
    iconBg: "bg-blue-100",
    progressBar: "bg-blue-600",
  },
  {
    icon: Building2,
    iconColor: "text-purple-600",
    iconBg: "bg-purple-100",
    progressBar: "bg-purple-600",
  },
];

const CollectorMetricCards = () => {
  const [cards, setCards] = useState([]);

  useEffect(() => {
    axios
      .get("/assets/data/CollectorsDashboardMetricsCards.json")
      .then((res) => setCards(res.data.cards))
      .catch((err) => console.error("Error loading dashboard data:", err));
  }, []);

  return (
    <div className="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
      {cards.map((card, index) => {
        const { icon: Icon, iconColor, iconBg, progressBar } = iconConfig[index] || {};
        return (
          <div
            key={index}
            className="bg-white p-4 rounded shadow hover:shadow-md transition relative"
          >
            {Icon && (
              <div
                className={`absolute top-2 right-2 p-2 rounded-full ${iconBg}`}
              >
                <Icon className={`w-6 h-6 ${iconColor}`} />
              </div>
            )}
            <p className="text-sm text-gray-500">{card.title}</p>
            <h3 className="text-2xl font-bold my-3">{card.amount}</h3>
            <div className="flex items-center justify-between mb-1">
              <p className="text-xs text-gray-500">Progress</p>
              <p className="text-xs font-medium text-gray-600">
                {card.progress}%
              </p>
            </div>
            <div className="relative w-full h-2 bg-gray-200 rounded-full overflow-hidden">
              <div
                className={`h-full ${progressBar}`}
                style={{ width: `${card.progress}%` }}
              ></div>
            </div>
            <p className="text-xs mt-2">{card.transactions}</p>
          </div>
        );
      })}
    </div>
  );
};

export default CollectorMetricCards;
