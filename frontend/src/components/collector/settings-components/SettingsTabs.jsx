import React from "react";

const tabs = [
  { label: "Profile", icon: "ri-user-line", color: "text-green-600" },
  { label: "Notifications", icon: "ri-notification-2-line", color: "text-blue-500" },
  { label: "Security", icon: "ri-shield-keyhole-line", color: "text-purple-600" },
  { label: "Preferences", icon: "ri-settings-3-line", color: "text-yellow-500" },
  { label: "Data", icon: "ri-database-2-line", color: "text-indigo-500" },
  { label: "Help", icon: "ri-question-line", color: "text-gray-500" },
];

export default function SettingsTabs({ active, setActive }) {
  return (
    <div className="flex gap-2 mb-6 bg-gray-50 rounded-sm p-2">
      {tabs.map((tab, idx) => (
        <button
          key={tab.label}
          className={`flex items-center gap-2 px-10 py-1 rounded-sm font-medium transition-colors text-sm ${
            active === idx
              ? "bg-white text-green-700 border border-green-700"
              : "text-gray-500 hover:bg-white"
          }`}
          onClick={() => setActive(idx)}
        >
          <span className={`${tab.icon} text-lg ${tab.color}`} />
          {tab.label}
        </button>
      ))}
    </div>
  );
}
