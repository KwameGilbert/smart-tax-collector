import React from "react";
import ProfileDropdown from "../../financial/ProfileDropdown";


const CollectorHeader = () => {
  return (
    <header className="bg-white border-b border-gray-200 px-6 py-5">
      <div className="flex items-center justify-between">
        <div className="">
          <h1 className="text-md md:text-2xl font-bold">Collector Dashboard</h1>
        </div>
        {/* profile */}
        <div>
          <ProfileDropdown/>
        </div>
      </div>
    </header>
  );
};

export default CollectorHeader;
