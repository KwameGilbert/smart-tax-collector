import React, { useEffect, useState } from "react";
import axios from "axios";
import {
  BarChart,
  Bar,
  XAxis,
  YAxis,
  Tooltip,
  ResponsiveContainer,
  Cell,
} from "recharts";

// const colors = ["#22C55E", "#3B82F6", "#A855F7", "#EC4899", "#8B5CF6", "#10B981", "#EC4899"];

const colors = [
  "rgba(34, 197, 94, 0.7)",
  "rgba(59, 130, 246, 0.7)",
  "rgba(168, 85, 247, 0.7)",
  "rgba(236, 72, 153, 0.7)",
];

const borderColors = [
  "rgba(34, 197, 94, 1)",
  "rgba(59, 130, 246, 1)",
  "rgba(168, 85, 247, 1)",
  "rgba(236, 72, 153, 1)",
];

const VerticalBarChart = () => {
  const [chartData, setChartData] = useState([]);

  useEffect(() => {
    axios.get("/assets/data/verticalBarChart.json").then((res) => {
      setChartData(res.data);
    });
  }, []);

  return (
    <ResponsiveContainer width="100%" height={300}>
      <BarChart data={chartData}>
        <XAxis dataKey="name" />
        <YAxis />
        <Tooltip />
        <Bar dataKey="amount">
          {chartData.map((entry, index) => (
            <Cell
              key={`cell-${index}`}
              fill={colors[index % colors.length]}
              stroke={borderColors[index % borderColors.length]}
              strokeWidth={1.5}
            />
          ))}
        </Bar>
      </BarChart>
    </ResponsiveContainer>
  );
};

export default VerticalBarChart;
