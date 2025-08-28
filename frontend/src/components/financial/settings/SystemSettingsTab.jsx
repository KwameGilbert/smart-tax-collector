
import React, { useState } from "react";
import { FiMoon, FiSun, FiGlobe, FiBell, FiKey, FiShield, FiDownload, FiUpload, FiDatabase } from "react-icons/fi";
import { Button } from "../../ui/button";

const locales = ["en", "fr", "tw", "ha"];
const currencies = ["GHS", "USD", "EUR"];
const dummyAuditLog = [
  { action: "Changed theme to dark", user: "IT Admin", date: "2025-08-01 09:00" },
  { action: "Updated API key", user: "IT Admin", date: "2025-08-02 10:30" },
];

export default function SystemSettingsTab() {
  const [theme, setTheme] = useState("light");
  const [locale, setLocale] = useState("en");
  const [currency, setCurrency] = useState("GHS");
  const [notifications, setNotifications] = useState({ email: true, sms: false });
  //const [apiKey, setApiKey] = useState("sk_test_1234567890");
  const [showBackupModal, setShowBackupModal] = useState(false);
  const [showRestoreModal, setShowRestoreModal] = useState(false);

  const handleThemeSwitch = () => setTheme(theme === "light" ? "dark" : "light");
  const handleLocaleChange = (e) => setLocale(e.target.value);
  const handleCurrencyChange = (e) => setCurrency(e.target.value);
  const handleNotificationChange = (type) => setNotifications({ ...notifications, [type]: !notifications[type] });

  const handleBackup = () => {
    setShowBackupModal(false);
    alert("Backup started!");
  };
  const handleRestore = () => {
    setShowRestoreModal(false);
    alert("Restore started!");
  };

  return (
    <div className="p-4 space-y-6">
      {/* Theme & Localization */}
      <div className="bg-white rounded-lg shadow p-4 flex flex-col md:flex-row gap-6 items-center">
        <div className="flex-1">
          <h4 className="font-semibold mb-2 flex items-center gap-2"><FiMoon /> Theme</h4>
          <Button variant="outline" size="sm" onClick={handleThemeSwitch} className="flex items-center gap-2">
            {theme === "light" ? <FiSun className="text-yellow-500" /> : <FiMoon className="text-purple-600" />} Switch to {theme === "light" ? "Dark" : "Light"} Mode
          </Button>
        </div>
        <div className="flex-1">
          <h4 className="font-semibold mb-2 flex items-center gap-2"><FiGlobe /> Localization</h4>
          <div className="flex gap-2">
            <select value={locale} onChange={handleLocaleChange} className="border rounded p-2">
              {locales.map(l => <option key={l} value={l}>{l.toUpperCase()}</option>)}
            </select>
            <select value={currency} onChange={handleCurrencyChange} className="border rounded p-2">
              {currencies.map(c => <option key={c} value={c}>{c}</option>)}
            </select>
          </div>
        </div>
      </div>

      {/* Notification Preferences */}
      <div className="bg-white rounded-lg shadow p-4">
        <h4 className="font-semibold mb-2 flex items-center gap-2"><FiBell /> Notification Preferences</h4>
        <div className="flex gap-4">
          <label className="flex items-center gap-2">
            <input type="checkbox" checked={notifications.email} onChange={() => handleNotificationChange("email")} /> Email
          </label>
          <label className="flex items-center gap-2">
            <input type="checkbox" checked={notifications.sms} onChange={() => handleNotificationChange("sms")} /> SMS
          </label>
        </div>
      </div>

      {/* Backup & Restore */}
      {/* <div className="bg-white rounded-lg shadow p-4 flex gap-4 items-center">
        <div className="flex-1">
          <h4 className="font-semibold mb-2 flex items-center gap-2"><FiDatabase /> Backup & Restore</h4>
          <div className="flex gap-2">
            <Button variant="outline" size="sm" onClick={() => setShowBackupModal(true)} className="flex items-center gap-2"><FiDownload /> Backup Data</Button>
            <Button variant="outline" size="sm" onClick={() => setShowRestoreModal(true)} className="flex items-center gap-2"><FiUpload /> Restore Data</Button>
          </div>
        </div>
        <div className="flex-1">
          <h4 className="font-semibold mb-2 flex items-center gap-2"><FiKey /> API Key</h4>
          <input type="text" value={apiKey} onChange={e => setApiKey(e.target.value)} className="border rounded p-2 w-full" />
        </div>
      </div> */}

      {/* RBAC & Security */}
      {/* <div className="bg-white rounded-lg shadow p-4">
        <h4 className="font-semibold mb-2 flex items-center gap-2"><FiShield /> Role-Based Access Control</h4>
        <div className="text-sm">Manage user roles, permissions, and security settings. (Feature placeholder)</div>
      </div> */}

      {/* Audit Log */}
      <div className="bg-white rounded-lg shadow p-4">
        <h4 className="font-semibold mb-2 flex items-center gap-2"><FiDatabase /> Audit Log</h4>
        <ul className="list-disc pl-6 text-sm">
          {dummyAuditLog.map((log, idx) => (
            <li key={idx}><span className="font-medium">{log.action}</span> by {log.user} on {log.date}</li>
          ))}
        </ul>
      </div>

      {/* Backup Modal */}
      {showBackupModal && (
        <div className="fixed inset-0 bg-black bg-opacity-30 flex items-center justify-center z-50">
          <div className="bg-white rounded-lg shadow-lg p-6 w-full max-w-md relative">
            <button className="absolute top-2 right-2 text-gray-400 hover:text-gray-600" onClick={() => setShowBackupModal(false)}>&times;</button>
            <h4 className="font-semibold mb-4">Backup Data</h4>
            <div className="mb-4">Start a full system backup. This may take a few minutes.</div>
            <div className="flex justify-end gap-2 pt-2">
              <Button type="button" variant="outline" onClick={() => setShowBackupModal(false)}>Cancel</Button>
              <Button type="button" variant="default" onClick={handleBackup}>Start Backup</Button>
            </div>
          </div>
        </div>
      )}

      {/* Restore Modal */}
      {showRestoreModal && (
        <div className="fixed inset-0 bg-black bg-opacity-30 flex items-center justify-center z-50">
          <div className="bg-white rounded-lg shadow-lg p-6 w-full max-w-md relative">
            <button className="absolute top-2 right-2 text-gray-400 hover:text-gray-600" onClick={() => setShowRestoreModal(false)}>&times;</button>
            <h4 className="font-semibold mb-4">Restore Data</h4>
            <div className="mb-4">Restore system data from a previous backup. Select a backup version below.</div>
            <select className="w-full border rounded p-2 mb-4">
              <option>Backup 2025-08-01 (Full)</option>
              <option>Backup 2025-07-25 (Incremental)</option>
            </select>
            <div className="flex justify-end gap-2 pt-2">
              <Button type="button" variant="outline" onClick={() => setShowRestoreModal(false)}>Cancel</Button>
              <Button type="button" variant="default" onClick={handleRestore}>Restore</Button>
            </div>
          </div>
        </div>
      )}
    </div>
  );
}
