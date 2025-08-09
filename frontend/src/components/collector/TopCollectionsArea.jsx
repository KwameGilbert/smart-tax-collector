import React, { useEffect, useState } from "react";
import axios from "axios";

const COLORS = ["#22C55E", "#3B82F6", "#A855F7", "#EC4899", "#FBBF24"];

const TopCollectionAreas = () => {
  const [areas, setAreas] = useState([]);

  useEffect(() => {
    axios.get("/assets/data/topcollections.json").then((res) => {
      setAreas(res.data);
    });
  }, []);

  return (
    <div className="space-y-4">
      {areas.map((area, index) => {
        const percentage = (area.amount / areas[0].amount) * 100;

        return (
          <div key={index}>
            <div className="flex justify-between items-center text-sm">
              <span className="flex items-center gap-2 font-medium">
                <span
                  className="w-8 h-8 flex items-center justify-center text-xs text-white rounded-full"
                  style={{ backgroundColor: COLORS[index % COLORS.length] }}
                >
                  {index + 1}
                </span>
                {area.name}
              </span>
              <span className="font-semibold text-sm">GHS {area.amount.toFixed(2)}</span>
            </div>

            <div className="w-full bg-gray-200 rounded-full h-2 mt-3">
              <div
                className="h-2 rounded-full"
                style={{
                  width: `${percentage}%`,
                  backgroundColor: COLORS[index % COLORS.length],
                }}
              ></div>
            </div>
          </div>
        );
      })}
    </div>
  );
};

export default TopCollectionAreas;
