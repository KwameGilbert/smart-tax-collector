import React from "react";
import PerformanceHeader from "../../components/collector/components/PerformanceHeader";
import PerformanceCards from "../../components/collector/components/PerformanceCards";
import RecentActivities from "../../components/collector/components/RecentActivities";
import Achievements from "../../components/collector/components/Achievements";

export default function Performance() {
  return (
    <div className="min-h-screen py-8">
      <PerformanceHeader />
      <PerformanceCards />
      <div className="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
        <div className="md:col-span-2">
          <RecentActivities />
        </div>
        <div>
          <Achievements />
        </div>
      </div>
    </div>
  );
}
