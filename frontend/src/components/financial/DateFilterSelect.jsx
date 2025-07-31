import React, { useState } from "react";

const DateFilterSelect = () => {
  const [selectedRange, setSelectedRange] = useState("all");

  const ranges = [
    { value: "all", label: "All Time" },
    { value: "today", label: "Today" },
    { value: "yesterday", label: "Yesterday" },
    { value: "week", label: "Last 7 Days" },
    { value: "month", label: "This Month" },
    { value: "quarter", label: "This Quarter" },
    { value: "half", label: "Last 6 Months" },
    { value: "year", label: "This Year" }
  ];

  const handleChange = (e) => {
    setSelectedRange(e.target.value);
    console.log("Selected Range:", e.target.value);
    // You can trigger filtering logic or API calls here
  };

  return (
    <div className="relative mx-4 flex-grow max-w-md">
      <select
        value={selectedRange}
        onChange={handleChange}
        className="flex w-full md:w-64 px-4 py-2 text-sm bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none"
      >
        {ranges.map((range) => (
          <option key={range.value} value={range.value}>
            {range.label}
          </option>
        ))}
      </select>
    </div>
  );
};

export default DateFilterSelect;
