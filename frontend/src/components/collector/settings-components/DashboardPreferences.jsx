import React from "react";

const DashboardPreferences = () => (
  <div className="bg-white rounded-lg shadow-sm p-6">
    <h2 className="text-lg font-semibold mb-1">Dashboard Preferences</h2>
    <p className="text-xs text-gray-500 mb-4">Customize your dashboard experience</p>
    <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
      <div>
        <label className="block text-xs mb-1">Theme</label>
        <select className="w-full border rounded px-3 py-2 text-sm">
          <option>System</option>
          <option>Light</option>
          <option>Dark</option>
        </select>
      </div>
      <div>
        <label className="block text-xs mb-1">Currency</label>
        <select className="w-full border rounded px-3 py-2 text-sm">
          <option>USD ($)</option>
          <option>EUR (€)</option>
          <option>GBP (£)</option>
        </select>
      </div>
      <div>
        <label className="block text-xs mb-1">Language</label>
        <select className="w-full border rounded px-3 py-2 text-sm">
          <option>English</option>
          <option>French</option>
          <option>Spanish</option>
        </select>
      </div>
      <div>
        <label className="block text-xs mb-1">Timezone</label>
        <select className="w-full border rounded px-3 py-2 text-sm">
          <option>Eastern Standard Time</option>
          <option>Central European Time</option>
          <option>Greenwich Mean Time</option>
        </select>
      </div>
    </div>
  </div>
);

export default DashboardPreferences;
