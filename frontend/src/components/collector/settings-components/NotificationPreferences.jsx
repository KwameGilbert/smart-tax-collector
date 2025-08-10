import React from "react";

const NotificationPreferences = () => (
  <div className="bg-white rounded-lg shadow-sm p-6">
    <h2 className="text-lg font-semibold mb-1">Notification Preferences</h2>
    <p className="text-xs text-gray-500 mb-4">Choose how you want to be notified about important events</p>
    <div className="space-y-4">
      {[
        { label: "Email notifications for new collections", enabled: true },
        { label: "Push notifications for target achievements", enabled: true },
        { label: "SMS alerts for urgent cases", enabled: false },
        { label: "Weekly performance reports", enabled: true },
        { label: "Team leaderboard updates", enabled: true },
      ].map((item, idx) => (
        <div key={idx} className="flex items-center justify-between border-b last:border-b-0 pb-2">
          <span className="text-sm">{item.label}</span>
          <button
            className={`w-10 h-6 flex items-center bg-gray-200 rounded-full p-1 transition-colors ${item.enabled ? 'bg-green-500' : 'bg-gray-200'}`}
            aria-pressed={item.enabled}
          >
            <span
              className={`bg-white w-4 h-4 rounded-full shadow transform transition-transform ${item.enabled ? 'translate-x-4' : ''}`}
            />
          </button>
        </div>
      ))}
    </div>
  </div>
);

export default NotificationPreferences;
