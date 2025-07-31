import React, { useState, useRef, useEffect } from "react";
import { Link } from "react-router-dom";
import {
  RiUserLine,
  RiUserSettingsLine,
  RiSettingsLine,
  RiLogoutBoxLine,
} from "react-icons/ri";

const ProfileDropdown = () => {
  const [open, setOpen] = useState(false);
  const dropdownRef = useRef();

  // Close dropdown when clicking outside
  useEffect(() => {
    const handleClickOutside = (event) => {
      if (dropdownRef.current && !dropdownRef.current.contains(event.target)) {
        setOpen(false);
      }
    };
    document.addEventListener("mousedown", handleClickOutside);
    return () => document.removeEventListener("mousedown", handleClickOutside);
  }, []);

  return (
    <div className="flex items-center space-x-4 relative" ref={dropdownRef}>
      {/* Profile button */}
      <button
        onClick={() => setOpen(!open)}
        className="flex items-center justify-center h-10 w-10 rounded-full bg-blue-100 hover:bg-blue-200 focus:outline-none transition-colors duration-150"
      >
        <RiUserLine className="text-blue-600 text-xl" />
      </button>

      {/* Dropdown menu */}
      {open && (
        <div className="absolute right-2 top-12 w-48 bg-white rounded-md shadow-lg py-1 z-50">
          <Link
            to="/profile"
            className="px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 flex items-center"
          >
            <RiUserSettingsLine className="mr-2" /> Profile
          </Link>
          <Link
            to="/settings"
            className="px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 flex items-center"
          >
            <RiSettingsLine className="mr-2" /> Settings
          </Link>
          <div className="border-t border-gray-100 my-1"></div>
          <Link
            to="/logout"
            className="px-4 py-2 text-sm text-red-600 hover:bg-gray-100 flex items-center"
          >
            <RiLogoutBoxLine className="mr-2" /> Log Out
          </Link>
        </div>
      )}
    </div>
  );
};

export default ProfileDropdown;
