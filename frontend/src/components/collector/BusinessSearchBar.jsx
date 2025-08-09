import React, { useState } from "react";
import { RiSearchLine, RiQrScanLine, RiFilter3Line } from "react-icons/ri";

const BusinessSearchBar = ({ categories = [], zones = [] }) => {
  const [searchTerm, setSearchTerm] = useState("");
  const [category, setCategory] = useState("");
  const [zone, setZone] = useState("");
  const [taxStatus, setTaxStatus] = useState("all");
  const [showFilters, setShowFilters] = useState(false);

  const handleReset = () => {
    setCategory("");
    setZone("");
    setTaxStatus("all");
    setSearchTerm("");
  };

  const handleApplyFilters = () => {
    // You can call your API or update a filtered list here
    console.log({ searchTerm, category, zone, taxStatus });
  };

  return (
    <div className="bg-white rounded-lg shadow-sm border border-gray-200 p-4 mb-6">
      {/* Search Bar */}
      <div className="flex flex-col md:flex-row md:items-center mb-4">
        <div className="relative flex-grow mb-3 md:mb-0 md:mr-4">
          <div className="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
            <RiSearchLine className="text-gray-400" />
          </div>
          <input
            type="text"
            id="business-search"
            className="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-primary-500 focus:border-primary-500"
            placeholder="Search by business name, owner, ID..."
            value={searchTerm}
            onChange={(e) => setSearchTerm(e.target.value)}
          />
        </div>

        <div className="flex space-x-2">
          <button
            id="scan-qr"
            className="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-primary-700 flex items-center"
          >
            <RiQrScanLine className="mr-2" />
            Scan QR Code
          </button>
          <button
            id="filter-toggle"
            className="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 flex items-center"
            onClick={() => setShowFilters(!showFilters)}
          >
            <RiFilter3Line className="mr-2" />
            Filters
          </button>
        </div>
      </div>

      {/* Advanced Filters */}
      {showFilters && (
        <div className="pt-4 border-t border-gray-200">
          <div className="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
            {/* Category Filter */}
            <div>
              <label
                htmlFor="category-filter"
                className="block text-sm font-medium text-gray-700 mb-1"
              >
                Business Category
              </label>
              <select
                id="category-filter"
                value={category}
                onChange={(e) => setCategory(e.target.value)}
                className="block w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-primary-500 focus:border-primary-500"
              >
                <option value="">All Categories</option>
                {categories.map((cat, idx) => (
                  <option key={idx} value={cat}>
                    {cat}
                  </option>
                ))}
              </select>
            </div>

            {/* Zone Filter */}
            <div>
              <label
                htmlFor="zone-filter"
                className="block text-sm font-medium text-gray-700 mb-1"
              >
                Zone
              </label>
              <select
                id="zone-filter"
                value={zone}
                onChange={(e) => setZone(e.target.value)}
                className="block w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-primary-500 focus:border-primary-500"
              >
                <option value="">All Zones</option>
                {zones.map((z, idx) => (
                  <option key={idx} value={z}>
                    {z}
                  </option>
                ))}
              </select>
            </div>

            {/* Tax Status Filter */}
            <div>
              <label
                htmlFor="tax-status-filter"
                className="block text-sm font-medium text-gray-700 mb-1"
              >
                Tax Status
              </label>
              <select
                id="tax-status-filter"
                value={taxStatus}
                onChange={(e) => setTaxStatus(e.target.value)}
                className="block w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-primary-500 focus:border-primary-500"
              >
                <option value="all">All Statuses</option>
                <option value="overdue">Overdue</option>
                <option value="due-soon">Due Soon</option>
                <option value="paid">Up to Date</option>
              </select>
            </div>
          </div>

          <div className="flex justify-end">
            <button
              id="reset-filters"
              className="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg mr-2 hover:bg-gray-100"
              onClick={handleReset}
            >
              Reset
            </button>
            <button
              id="apply-filters"
              className="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-primary-700"
              onClick={handleApplyFilters}
            >
              Apply Filters
            </button>
          </div>
        </div>
      )}
    </div>
  );
};

export default BusinessSearchBar;
