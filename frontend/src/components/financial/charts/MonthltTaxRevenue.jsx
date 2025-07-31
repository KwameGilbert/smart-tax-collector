import React, { useEffect, useState } from 'react';
import axios from 'axios';
import {
  BarChart,
  Bar,
  XAxis,
  YAxis,
  CartesianGrid,
  Tooltip,
  ResponsiveContainer
} from 'recharts';

const MonthlyRevenueChart = () => {
  const [chartData, setChartData] = useState([]);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    axios.get('/assets/data/monthlyrevenue.json')
      .then((response) => {
        const data = response.data;
        if (Array.isArray(data)) {
          setChartData(data);
        } else {
          console.error('Chart data is not an array:', data);
        }
        setLoading(false);
      })
      .catch((error) => {
        console.error('Failed to fetch chart data:', error);
        setLoading(false);
      });
  }, []);

  return (
    <div className="bg-white rounded-lg shadow p-6">
      <div className="mb-4">
        <h2 className="text-xl font-semibold">Monthly Revenue</h2>
        <p className="text-gray-500 text-sm">Revenue collected per month (GHS)</p>
      </div>
      <div className="h-80">
        {loading ? (
          <div className="text-center text-gray-500">Loading chart...</div>
        ) : chartData.length === 0 ? (
          <div className="text-center text-gray-500">No data available</div>
        ) : (
          <ResponsiveContainer width="100%" height="100%">
            <BarChart data={chartData}>
              <CartesianGrid strokeDasharray="3 3" />
              <XAxis dataKey="month" />
              <YAxis
                // tickFormatter={(value) => `GHS ${value.toLocaleString()}`}
                tick={{ fontSize: 12 }}
              />
              <Tooltip
                formatter={(value) => `GHS ${value.toLocaleString()}`}
                contentStyle={{ fontSize: '12px' }}
              />
              <Bar
                dataKey="revenue"
                name="Revenue"
                fill="#9698F9EF" // hex background fill
                stroke="#7275F9FF" // border
                strokeWidth={2.0}
              />
            </BarChart>
          </ResponsiveContainer>
        )}
      </div>
    </div>
  );
};

export default MonthlyRevenueChart;
