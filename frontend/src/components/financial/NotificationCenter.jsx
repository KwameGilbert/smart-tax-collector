// src/pages/NotificationCenter.jsx
import React, { useEffect, useState } from "react";
import axios from "axios";
import {
  RiCheckDoubleLine,
  RiSearchLine,
  RiCalendarEventLine,
  RiMoneyDollarCircleLine,
  RiStore2Line,
  RiCheckLine,
  RiRefreshLine
} from "react-icons/ri";

const filters = ["All", "Unread", "High Priority", "Payments", "Businesses", "System"];

const NotificationCenter = () => {
  const [notifications, setNotifications] = useState([]);
  const [filtered, setFiltered] = useState([]);
  const [filter, setFilter] = useState("All");
  const [searchTerm, setSearchTerm] = useState("");

  useEffect(() => {
    axios.get("/assets/data/notificationcenter.json")
      .then((res) => {
        const updated = res.data.map(n => ({ ...n, read: n.read || false }));
        setNotifications(updated);
      })
      .catch((err) => console.error(err));
  }, []);

  useEffect(() => {
    let data = [...notifications];

    if (filter === "Unread") {
      data = data.filter(n => !n.read);
    } else if (filter !== "All") {
      data = data.filter(n => n.category === filter);
    }

    if (searchTerm.trim()) {
      data = data.filter(n =>
        n.title.toLowerCase().includes(searchTerm.toLowerCase())
      );
    }

    setFiltered(data);
  }, [filter, searchTerm, notifications]);

  const markAsRead = (id) => {
    setNotifications((prev) =>
      prev.map((n) =>
        n.id === id ? { ...n, read: true } : n
      )
    );
  };

  const markAllAsRead = () => {
    setNotifications((prev) => prev.map((n) => ({ ...n, read: true })));
  };

  return (
    <div className="bg-gray-100 min-h-screen p-8">
      <div className="flex justify-between items-center mb-6">
        <div>
          <h1 className="text-3xl font-bold">Notification Center</h1>
          <p className="text-gray-600">Stay updated on important events and actions</p>
        </div>
        <button
          onClick={markAllAsRead}
          className="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 flex items-center"
        >
          <RiCheckDoubleLine className="mr-2" /> Mark All as Read
        </button>
      </div>

      {/* Filters */}
      <div className="mb-6 bg-white p-4 rounded-lg shadow flex flex-wrap gap-2 items-center justify-between">
        <div className="flex flex-wrap gap-2">
          {filters.map((f) => (
            <button
              key={f}
              onClick={() => setFilter(f)}
              className={`px-3 py-1 rounded text-sm transition ${
                filter === f
                  ? "bg-blue-800 text-white"
                  : "bg-gray-100 hover:bg-gray-200"
              }`}
            >
              {f}
            </button>
          ))}
        </div>
        <div className="relative">
          <input
            type="text"
            placeholder="Search notifications..."
            value={searchTerm}
            onChange={(e) => setSearchTerm(e.target.value)}
            className="pl-10 pr-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500"
          />
          <div className="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
            <RiSearchLine />
          </div>
        </div>
      </div>

      {/* Notification List */}
      <div className="space-y-4">
        {filtered.map((n) => (
          <div
            key={n.id}
            className={`border-l-4 p-5 rounded-lg shadow relative transition ${
              n.read
                ? "bg-green-100 border-green-300"
                : n.category === "Payments"
                ? "bg-yellow-100 border-yellow-200"
                : "bg-yellow-50 border-yellow-100"
            }`}
          >
            <div className="flex">
              <div className="flex-shrink-0">
                <div
                  className={`p-3 rounded-full ${
                    n.category === "Payments"
                      ? "bg-green-200 text-green-800"
                      : "bg-yellow-200 text-yellow-800"
                  }`}
                >
                  {n.icon === "calendar" ? (
                    <RiCalendarEventLine className="text-xl" />
                  ) : (
                    <RiMoneyDollarCircleLine className="text-xl" />
                  )}
                </div>
              </div>
              <div className="ml-4 flex-1">
                <div className="flex justify-between items-start">
                  <h3
                    className={`text-lg font-medium ${
                      n.read
                        ? "text-green-800"
                        : n.category === "Payments"
                        ? "text-yellow-800"
                        : "text-yellow-900"
                    }`}
                  >
                    {n.title}
                  </h3>
                  <span className="text-sm text-gray-500">{n.date}</span>
                </div>
                <p className="mt-1 text-gray-700">{n.message}</p>
                <div className="mt-3 flex flex-wrap justify-between items-center">
                  <div className="flex gap-3">
                    {n.business && (
                      <a
                        href="#"
                        className="text-sm text-blue-600 hover:text-blue-800 flex items-center"
                      >
                        <RiStore2Line className="mr-1" /> View {n.business}
                      </a>
                    )}
                    {n.payment && (
                      <a
                        href="#"
                        className="text-sm text-green-600 hover:text-green-800 flex items-center"
                      >
                        <RiMoneyDollarCircleLine className="mr-1" /> Record Payment
                      </a>
                    )}
                  </div>
                  {!n.read && (
                    <button
                      onClick={() => markAsRead(n.id)}
                      className="text-xs bg-blue-50 text-blue-700 px-2 py-1 rounded hover:bg-blue-100 ml-2 flex items-center"
                    >
                      <RiCheckLine className="mr-1" /> Mark as Read
                    </button>
                  )}
                </div>
              </div>
            </div>
          </div>
        ))}

        {filtered.length === 0 && (
          <div className="text-center text-gray-600 mt-10">No notifications found.</div>
        )}

        <div className="text-center mt-6">
          <button className="px-4 py-2 border border-gray-300 bg-white rounded hover:bg-gray-50 flex items-center">
            <RiRefreshLine className="mr-2" /> Load More
          </button>
        </div>
      </div>
    </div>
  );
};

export default NotificationCenter;
