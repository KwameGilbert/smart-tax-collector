import React from "react";

const SecuritySettings = () => (
  <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
    <div className="bg-white rounded-lg shadow-sm p-6">
      <h2 className="text-lg font-semibold mb-1">Security Settings</h2>
      <p className="text-xs text-gray-500 mb-4">Manage your account security and privacy</p>
      <div className="space-y-4">
        {[
          { label: "Two-factor authentication", enabled: true },
          { label: "Auto logout after inactivity", enabled: true },
          { label: "Email alerts for new logins", enabled: true },
          { label: "Manage trusted devices", enabled: false },
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
    <div className="bg-white rounded-lg shadow-sm p-6">
      <h2 className="text-lg font-semibold mb-1">Change Password</h2>
      <p className="text-xs text-gray-500 mb-4">Update your account password</p>
      <form className="space-y-4">
        <div>
          <label className="block text-xs mb-1">Current Password</label>
          <input type="password" className="w-full border rounded px-3 py-2 text-sm" />
        </div>
        <div>
          <label className="block text-xs mb-1">New Password</label>
          <input type="password" className="w-full border rounded px-3 py-2 text-sm" />
        </div>
        <div>
          <label className="block text-xs mb-1">Confirm New Password</label>
          <input type="password" className="w-full border rounded px-3 py-2 text-sm" />
        </div>
        <button type="submit" className="w-full bg-green-500 text-white py-2 rounded">Update Password</button>
      </form>
    </div>
  </div>
);

export default SecuritySettings;
