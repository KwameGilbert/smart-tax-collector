import React, { useEffect, useState } from "react";
import axios from "axios";

const CollectorCards = () => {
  const [collectors, setCollectors] = useState([]);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    axios
      .get("/assets/data/collectors.json") 
      .then((res) => {
        setCollectors(res.data);
        setLoading(false);
      })
      .catch((err) => {
        console.error("Error fetching collectors:", err);
        setLoading(false);
      });
  }, []);

  if (loading) {
    return <div className="text-center py-10 text-gray-500">Loading collectors...</div>;
  }

  return (
    <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-6">
      {collectors.map((collector, index) => (
        <div
          key={index}
          className="bg-white rounded-lg shadow overflow-hidden"
        >
          <div className="py-6 px-3">
            <div className="flex items-center mb-4">
              <div className="h-12 w-12 rounded-full bg-blue-100 flex items-center justify-center text-blue-500 mr-4">
                <i className="ri-user-line text-2xl"></i>
              </div>
              <div>
                <h3 className="text-lg font-medium text-gray-900">
                  {collector.name}
                </h3>
                <p className="text-sm text-gray-500">{collector.location}</p>
              </div>
              <div className="ml-auto">
                <span
                  className={`px-2 py-1 text-xs rounded-full ${
                    collector.status === "Active"
                      ? "bg-green-100 text-green-600"
                      : "bg-red-100 text-red-600"
                  }`}
                >
                  {collector.status}
                </span>
              </div>
            </div>

            <div className="border-t border-gray-100 pt-4">
              <div className="grid grid-cols-3 gap-3 mt-4 mb-8 text-start">
                <div>
                  <p className="text-xs text-gray-500">Today</p>
                  <p className="text-sm font-semibold my-2">{collector.today.amount}</p>
                  <p className="text-xs text-gray-500">{collector.today.count} payments</p>
                </div>
                <div>
                  <p className="text-xs text-gray-500">Week</p>
                  <p className="text-sm font-semibold my-2">{collector.week.amount}</p>
                  <p className="text-xs text-gray-500">{collector.week.count} payments</p>
                </div>
                <div>
                  <p className="text-xs text-gray-500">Month</p>
                  <p className="text-sm font-semibold my-2">{collector.month.amount}</p>
                  <p className="text-xs text-gray-500">{collector.month.count} payments</p>
                </div>
              </div>

              <div className="flex items-center justify-between text-sm">
                <div>
                  <i
                    className={`ri-smartphone-line mr-1 ${
                      collector.online ? "text-green-500" : "text-gray-400"
                    }`}
                  ></i>{" "}
                  {collector.online ? "Online" : "Offline"}
                </div>
                <div
                  className={`${
                    collector.performance === "High"
                      ? "text-blue-600"
                      : "text-yellow-600"
                  }`}
                >
                  <i className="ri-bar-chart-line mr-1"></i>
                  {collector.performance} Performance
                </div>
              </div>
            </div>
          </div>

          <div className="bg-gray-50 px-6 py-4 border-t border-gray-100">
            <div className="flex justify-between items-center text-sm">
              <div>
                <span className="text-gray-500">Last collection:</span>{" "}
                <span className="text-blue-600">
                  {collector.lastCollection}
                </span>
              </div>
              <div className="flex space-x-2">
                <a
                  href={collector.viewUrl || "#"}
                  className="text-sm px-3 py-1 bg-blue-100 text-blue-700 rounded-md hover:bg-blue-200"
                >
                  View Details
                </a>
                <button className="text-gray-400 hover:text-gray-600">
                  <i className="ri-more-2-line"></i>
                </button>
              </div>
            </div>
          </div>
        </div>
      ))}
    </div>
  );
};

export default CollectorCards;
