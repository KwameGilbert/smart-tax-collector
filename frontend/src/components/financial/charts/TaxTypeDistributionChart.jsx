import React, { useEffect, useState } from "react";
import {
  PieChart,
  Pie,
  Tooltip,
  Cell,
  Legend,
  ResponsiveContainer,
} from "recharts";
import axios from "axios";

const COLORS = [
  "#36A2EBB3",
  "#FF9F40B3",
  "#4BC0C0B3",
  "#9966FFB3",
  "#E91E63B3",
  "#a4de6c",
  "#d0ed57",
  "#d62728",
  "#ff7f0e",
  "#2ca02c",
];

const TaxTypeDistributionChart = () => {
  const [chartData, setChartData] = useState([]);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    axios
      .get("/assets/data/taxDistributionData.json")
      .then((res) => {
        const { labels, data } = res.data;

        const formattedData = labels.map((label, index) => ({
          name: label,
          value: data[index],
        }));

        setChartData(formattedData);
        setLoading(false);
      })
      .catch((err) => {
        console.error("Failed to load chart data:", err);
        setLoading(false);
      });
  }, []);

  return (
    <div className="bg-white rounded-lg shadow p-6">
      <div className="mb-4">
        <h2 className="text-xl font-semibold">Tax Type Distribution</h2>
        <p className="text-gray-500 text-sm">
          Percentage of each tax type in total revenue
        </p>
      </div>

      <div className="h-80">
        {loading ? (
          <p className="text-gray-500">Loading chart...</p>
        ) : (
          <ResponsiveContainer width="100%" height="100%">
            <PieChart>
              <Pie
                data={chartData}
                dataKey="value"
                nameKey="name"
                cx="50%"
                cy="50%"
                innerRadius={60}
                outerRadius={120}
                paddingAngle={3}
                labelLine={false}
                
              >
                {chartData.map((_, index) => (
                  <Cell
                    key={`cell-${index}`}
                    fill={COLORS[index % COLORS.length]}
                  />
                ))}
              </Pie>
              <Tooltip formatter={(value) => `${value.toLocaleString()}%`} />
              <Legend />
            </PieChart>
          </ResponsiveContainer>
        )}
      </div>
    </div>
  );
};

export default TaxTypeDistributionChart;
