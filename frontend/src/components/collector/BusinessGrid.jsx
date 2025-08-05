import React, { useEffect, useState } from "react";
import axios from "axios";
import { Link } from "react-router-dom";
import {
  RiErrorWarningLine,
  RiTimeLine,
  RiMapPinLine,
  RiStore2Line,
  RiUserLine,
  RiPhoneLine,
  RiArrowRightLine,
  RiQrScanLine,
  RiAddLine,
} from "react-icons/ri";
import { Button } from "@/components/ui/button";
import {
  Pagination,
  PaginationContent,
  PaginationItem,
  PaginationPrevious,
  PaginationNext,
} from "@/components/ui/pagination";

const ITEMS_PER_PAGE = 10;

const getStatusClass = (dueDate) => {
  const due = new Date(dueDate);
  const now = new Date();
  return due < now ? "bg-red-100 text-red-700" : "bg-green-100 text-green-700";
};

const getStatusText = (dueDate) => {
  const due = new Date(dueDate);
  const now = new Date();
  return due < now ? "Overdue" : "Due Soon";
};

const formatCurrency = (num) => `$${parseFloat(num).toFixed(2)}`;

const BusinessGrid = () => {
  const [businesses, setBusinesses] = useState([]);
  const [currentPage, setCurrentPage] = useState(1);
  const [activeFilter, setActiveFilter] = useState("all");

  useEffect(() => {
    axios
      .get("/assets/data/businessgriddata.json")
      .then((res) => setBusinesses(res.data));
  }, []);

  const indexOfLast = currentPage * ITEMS_PER_PAGE;
  const indexOfFirst = indexOfLast - ITEMS_PER_PAGE;
  const currentItems = businesses.slice(indexOfFirst, indexOfLast);
  const totalPages = Math.ceil(businesses.length / ITEMS_PER_PAGE);

  return (
    <div className="">
      {/* Quick Filter Tags */}
      <div className="flex flex-wrap gap-2 mb-6">
        <Button
          variant="outline"
          className={`rounded-full text-sm font-medium ${
            activeFilter === "all" ? "bg-green-600 text-white" : ""
          }`}
          onClick={() => setActiveFilter("all")}
        >
          All Businesses
        </Button>

        <Button
          variant="outline"
          className={`rounded-full text-sm font-medium ${
            activeFilter === "overdue" ? "bg-green-600 text-white" : ""
          }`}
          onClick={() => setActiveFilter("overdue")}
        >
          <RiErrorWarningLine className="mr-1 text-red-500" /> Overdue
        </Button>

        <Button
          variant="outline"
          className={`rounded-full text-sm font-medium ${
            activeFilter === "due_this_month" ? "bg-green-600 text-white" : ""
          }`}
          onClick={() => setActiveFilter("due_this_month")}
        >
          <RiTimeLine className="mr-1 text-yellow-500" /> Due This Month
        </Button>

        <Button
          variant="outline"
          className={`rounded-full text-sm font-medium ${
            activeFilter === "central_market" ? "bg-green-600 text-white" : ""
          }`}
          onClick={() => setActiveFilter("central_market")}
        >
          <RiMapPinLine className="mr-1 text-blue-500" /> Central Market
        </Button>

        <Button
          variant="outline"
          className={`rounded-full text-sm font-medium ${
            activeFilter === "recent" ? "bg-green-600 text-white" : ""
          }`}
          onClick={() => setActiveFilter("recent")}
        >
          <RiStore2Line className="mr-1 text-green-500" /> Recently Added
        </Button>
      </div>

      {/* Business Cards Grid */}
      <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-6">
        {currentItems.map((business, index) => (
          <div
            key={index}
            className="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden"
          >
            <div className="px-3 py-5">
              <div className="flex items-center justify-between mb-4">
                <div className="flex items-center">
                  <div className="h-10 w-10 rounded-full bg-green-100 flex items-center justify-center text-green-600 mr-3">
                    <RiStore2Line className="text-xl" />
                  </div>
                  <div>
                    <h3 className="font-semibold text-gray-800">
                      {business.name}
                    </h3>
                    <p className="text-sm text-gray-500">{business.id}</p>
                  </div>
                </div>
                <span className="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                  {business.category}
                </span>
              </div>

              <div className="space-y-2 my-5">
                <div className="flex items-start">
                  <RiUserLine className="text-gray-400 mr-2 mt-0.5" />
                  <span className="text-sm text-gray-600">
                    {business.owner}
                  </span>
                </div>
                <div className="flex items-start">
                  <RiMapPinLine className="text-gray-400 mr-2 mt-0.5" />
                  <span className="text-sm text-gray-600">
                    {business.location}
                  </span>
                </div>
                <div className="flex items-start">
                  <RiPhoneLine className="text-gray-400 mr-2 mt-0.5" />
                  <span className="text-sm text-gray-600">
                    {business.phone}
                  </span>
                </div>
              </div>

              <div className="bg-gray-50 rounded-md p-3 mb-5">
                <div className="flex justify-between items-center mb-2">
                  <span className="text-sm font-medium text-gray-700">
                    Total Due:
                  </span>
                  <span className="text-lg font-bold text-green-600">
                    {formatCurrency(business.tax_balance)}
                  </span>
                </div>
                <div className="space-y-1">
                  {business.taxes_due.map((tax, i) => (
                    <div key={i} className="flex justify-between items-center">
                      <span className="text-xs text-gray-500">{tax.name}</span>
                      <div className="flex items-center">
                        <span className="text-xs font-medium mr-2">
                          {formatCurrency(tax.amount)}
                        </span>
                        <span
                          className={`inline-flex items-center px-1.5 py-0.5 rounded-full text-xs font-medium ${getStatusClass(
                            tax.due_date
                          )}`}
                        >
                          {getStatusText(tax.due_date)}
                        </span>
                      </div>
                    </div>
                  ))}
                </div>
              </div>

              <div className="flex justify-between items-center">
                <span className="text-xs text-gray-500">
                  Last payment:{" "}
                  {new Date(business.last_payment).toLocaleDateString()}
                </span>
                <Link
                  to={`collect-payment?business_id=${business.id}`}
                  className="px-3 py-1 bg-green-600 text-white text-sm font-medium rounded-md hover:bg-green-700 transition-colors"
                >
                  Collect <RiArrowRightLine className="inline ml-1" />
                </Link>
              </div>
            </div>
          </div>
        ))}
      </div>

      {/* Mobile Quick Actions */}
      <div className="fixed bottom-6 right-6 flex flex-col space-y-2 md:hidden">
        <button className="h-14 w-14 rounded-full bg-green-600 text-white flex items-center justify-center shadow-lg hover:bg-green-700">
          <RiQrScanLine className="text-xl" />
        </button>
        <button className="h-14 w-14 rounded-full bg-gray-800 text-white flex items-center justify-center shadow-lg hover:bg-gray-900">
          <RiAddLine className="text-xl" />
        </button>
      </div>

      {/* Pagination */}
      <div className="mt-6">
        <Pagination>
          <PaginationContent className="justify-between w-full">
            <PaginationItem>
              <PaginationPrevious
                onClick={() => setCurrentPage((prev) => Math.max(prev - 1, 1))}
                className={
                  currentPage === 1 ? "pointer-events-none opacity-50" : ""
                }
              />
            </PaginationItem>
            <span className="text-sm text-gray-500 self-center">
              Page {currentPage} of {totalPages}
            </span>
            <PaginationItem>
              <PaginationNext
                onClick={() =>
                  setCurrentPage((prev) => Math.min(prev + 1, totalPages))
                }
                className={
                  currentPage === totalPages
                    ? "pointer-events-none opacity-50"
                    : ""
                }
              />
            </PaginationItem>
          </PaginationContent>
        </Pagination>
      </div>
    </div>
  );
};

export default BusinessGrid;
