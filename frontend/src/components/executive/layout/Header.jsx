import React from "react";
import DateFilterSelect from "../../financial/DateFilterSelect";
import ProfileDropdown from "../../financial/ProfileDropdown";

const ExecutiveHeader = () => {
  return (
    <header className="bg-white border-b border-gray-200 px-6 py-5">
      <div className="flex items-center justify-between">
        <div className="">
          <h1 className="text-md md:text-2xl font-bold">Executive Dashboard</h1>
        </div>

        <div className="">
          <DateFilterSelect />
        </div>

        {/* profile */}
        <div>
          <ProfileDropdown />
        </div>
      </div>
    </header>
  );
};

export default ExecutiveHeader;
