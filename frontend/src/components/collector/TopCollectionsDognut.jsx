import React, { useEffect, useState } from "react";
import axios from "axios";
import { PieChart, Pie, Cell, ResponsiveContainer, Legend } from "recharts";

const DonutChart = () => {
  const [areas, setAreas] = useState([]);

  useEffect(() => {
    axios
      .get("../../../public/assets/data/topcollectiondognut.json")
      .then((res) => {
        setAreas(res.data);
      });
  }, []);

  const COLORS = [
    "rgba(251, 191, 36, 0.8)",
    "rgba(156, 163, 175, 0.8)",
    "rgba(217, 119, 6, 0.8)",
    "rgba(96, 165, 250, 0.8)",
  ];

  return (
    <ResponsiveContainer width="100%" height={300}>
      <PieChart>
        <Pie
          data={areas}
          dataKey="amount"
          nameKey="name"
          cx="50%"
          cy="50%"
          innerRadius={40}
          outerRadius={90}
        >
          {areas.map((area, index) => (
            <Cell key={`cell-${index}`} fill={COLORS[index % COLORS.length]} />
          ))}
        </Pie>
        <Legend />
      </PieChart>
    </ResponsiveContainer>
  );
};

export default DonutChart;
