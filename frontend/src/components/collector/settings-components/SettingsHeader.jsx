import React from "react";

export default function SettingsHeader() {
  return (
    <div className="flex flex-col md:flex-row md:items-center md:justify-between mb-6 gap-4">
      <div>
        <h1 className="text-2xl font-bold text-gray-800">Settings</h1>
        <p className="text-gray-600">Manage your account preferences and dashboard settings</p>
      </div>
      <button className="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-lg font-semibold shadow flex items-center gap-2">
        Save Changes
      </button>
    </div>
  );
}
