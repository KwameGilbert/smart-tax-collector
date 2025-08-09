import React from "react";
import CollectorCards from "./CollectorsCards";
import MonthlyCollectionsChart from "../../components/financial/MonthlyCollectors";

const CollectorsManagement = () => {
  return (
    <div>
      <div class="mb-6">
        <h1 class="text-2xl font-semibold text-gray-700">Collectors</h1>
        <p class="text-gray-500 text-sm">
          Manage and monitor collection agents.
        </p>
      </div>

      <div>
        <CollectorCards/>
      </div>

      <MonthlyCollectionsChart/>
    </div>
  );
};

export default CollectorsManagement;
