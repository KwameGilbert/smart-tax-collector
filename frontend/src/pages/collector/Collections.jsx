import React from "react";
import CollectionsSummary from "../../components/collector/collections/CollectionsSummary";
import CollectionsFilters from "../../components/collector/collections/CollectionsFilters";
import CollectionsOverTime from "../../components/collector/collections/CollectionsOverTime";
import CollectionsByPaymentMethod from "../../components/collector/collections/CollectionsByPaymentMethod";
import CollectionHistoryTable from "../../components/collector/collections/CollectionHistoryTable";

export default function Collections() {
  return (
    <div className="min-h-screen">
      <div className="max-w-7xl mx-auto">
        <h2 className="text-xl font-bold mb-1 text-gray-800">My Collections</h2>
        <p className="text-sm text-gray-500 mb-4">View and manage your tax collection history</p>
        <CollectionsSummary />
        <CollectionsFilters />
        <div className="grid grid-cols-1 md:grid-cols-2 gap-3 mt-2">
          <CollectionsOverTime />
          <CollectionsByPaymentMethod />
        </div>
        <CollectionHistoryTable />
      </div>
    </div>
  );
}
