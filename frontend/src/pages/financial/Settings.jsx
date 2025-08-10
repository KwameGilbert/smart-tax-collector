import React, { useState } from "react";
import TaxTypesTab from "../../components/financial/settings/TaxTypesTab";
import ZonalsTab from "../../components/financial/settings/ZonalsTab";
import PaymentMethodsTab from "../../components/financial/settings/PaymentMethodsTab";
import SystemSettingsTab from "../../components/financial/settings/SystemSettingsTab";
import UserProfileTab from "../../components/financial/settings/UserProfileTab";

const tabs = [
  { label: "Tax Types", component: <TaxTypesTab /> },
  { label: "Zonals", component: <ZonalsTab /> },
  { label: "Payment Methods", component: <PaymentMethodsTab /> },
  { label: "System Settings", component: <SystemSettingsTab /> },
  { label: "User Profile", component: <UserProfileTab /> },
];

export default function Settings() {
  const [activeTab, setActiveTab] = useState(0);
  return (
    <div className="bg-gray-50 rounded-lg shadow p-6 min-h-[400px]">
      <div className="flex gap-2 border-b mb-4">
        {tabs.map((tab, idx) => (
          <button
            key={tab.label}
            className={`px-4 py-2 font-medium border-b-2 transition-colors ${activeTab === idx ? "border-blue-600 text-blue-700" : "border-transparent text-gray-500"}`}
            onClick={() => setActiveTab(idx)}
          >
            {tab.label}
          </button>
        ))}
      </div>
      <div>
        {tabs[activeTab].component}
      </div>
    </div>
  );
}
