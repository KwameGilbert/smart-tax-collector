import BusinessGrid from "@/components/collector/BusinessGrid";
import BusinessSearchBar from "@/components/collector/BusinessSearchBar";
import React from "react";


const categories = ["Retail", "Wholesale", "Services"];
const zones = ["Zone A", "Zone B", "Zone C"];

const SearchBusiness = () => {
  return (
    <div className="p-4">
      <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Search Businesses</h1>
        <p class="text-gray-600">Find businesses to collect taxes from</p>
      </div>

      <BusinessSearchBar categories={categories} zones={zones}/>

      <BusinessGrid/>
    </div>
  );
};

export default SearchBusiness;
