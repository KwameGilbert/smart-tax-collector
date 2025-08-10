import React, { useState } from "react";
import SettingsTabs from "../../components/collector/settings-components/SettingsTabs";
import ProfileInfoForm from "../../components/collector/settings-components/ProfileInfoForm";
import ProfessionalDetailsForm from "../../components/collector/settings-components/ProfessionalDetailsForm";
import NotificationPreferences from "../../components/collector/settings-components/NotificationPreferences";
import SecuritySettings from "../../components/collector/settings-components/SecuritySettings";
import DashboardPreferences from "../../components/collector/settings-components/DashboardPreferences";
import DataExportManagement from "../../components/collector/settings-components/DataExportManagement";
import SupportResources from "../../components/collector/settings-components/SupportResources";

// Notification Preferences Tab
// ...existing code...

const TAB_CONTENT = [
  {
    label: "Profile",
    content: <ProfileInfoForm />,
  },
  {
    label: "Notifications",
    content: <NotificationPreferences />,
  },
  {
    label: "Security",
    content: <SecuritySettings />,
  },
  {
    label: "Preferences",
    content: <DashboardPreferences />,
  },
  {
    label: "Data",
    content: <DataExportManagement />,
  },
  {
    label: "Help",
    content: <SupportResources />,
  },
];

const Settings = () => {
  const [activeTab, setActiveTab] = useState(0);
  return (
    <div className="min-h-screen">
      <div className="max-w-5xl mx-auto">
  <SettingsTabs active={activeTab} setActive={setActiveTab} />
        <div className="mt-6">
          {TAB_CONTENT[activeTab]?.content}
        </div>
      </div>
    </div>
  );
};

export default Settings;
