import React from "react";
// import { Progress } from "@/components/ui/progress";
import CollectorMetricCards from "../../components/collector/DashboardMetricsCards";
import QuickActions from "../../components/collector/QuickActions";
import TaxTypes from "../../components/collector/TaxTypes";
import TopCollectionAreas from "../../components/collector/TopCollectionsArea";
import DonutChart from "../../components/collector/TopCollectionsDognut";
//import RecentCollections from "../../components/collector/RecentCollection";

const CollectorDashboard = () => {
  return (
    <div className="">
      {/* Main Content */}
      <main className="flex-1 p-2">
        <h2 className="text-2xl font-bold mb-1">Welcome back, John!</h2>
        <p className="mb-4 text-gray-600">
          Here's your tax collection summary for today
        </p>

        <div>
          <CollectorMetricCards />
        </div>
        <div>
          <QuickActions />
        </div>

        <div className="flex items-start gap-5 flex-col md:flex-row">
          <TaxTypes />
          <div className="bg-white p-6 rounded shadow md:flex-[1.2] h-full w-full md:w-[80%]">
            <TopCollectionAreas />
            <div className="my-5">
              <DonutChart />
            </div>
          </div>
        </div>

        <div>{/* <RecentCollections/> */}</div>
      </main>
    </div>
  );
};

export default CollectorDashboard;
