import React from "react";
import { Link, useLocation } from "react-router-dom";
import { collectorsNavLinks } from "./CollectorNavLink";
import "remixicon/fonts/remixicon.css";
import { LogOut } from "lucide-react";

const CollectorSidebar = (probs) => {
  const location = useLocation();
  return (
    <div
      className={`bg-white text-slate-700 h-screen flex-col justify-between duration-700 hidden md:flex ${
        probs.showLabels && "w-64 duration-500"
      }`}
    >
      <div class="p-4 border-b border-gray-300 flex items-center">
        <div class="h-8 w-8 rounded-full bg-green-600 flex items-center justify-center text-white">
          <i class="ri-government-line text-lg"></i>
        </div>
        <h2 class="ml-3 text-lg font-semibold text-gray-800">
          Sefwi Collection
        </h2>
      </div>

      <div class="px-4 py-5 border-b border-gray-300">
        <div class="flex items-center">
          <img
            src="https://randomuser.me/api/portraits/men/32.jpg"
            alt="Profile Image"
            className="h-10 w-10 rounded-full object-cover"
          />
          <div class="ml-3">
            <p class="text-sm font-medium text-gray-800">John Anane</p>
            <p class="text-xs text-gray-500">Field Collector</p>
          </div>
        </div>
      </div>

      {/* navigation */}
      <div className="flex-1 p-4">
        {/* main section */}
        {collectorsNavLinks.map((item, index) => (
          <div className="mb-6" key={index}>
            <div>
              {probs.showLabels && (
                <h3 className="text-sm uppercase tracking-wider text-gray-500 font-semibold mb-2">
                  {item.title}
                </h3>
              )}
              <nav className="space-y-4">
                {item.menuItems.map((menuItem, idx) => {
                  const isActive = location.pathname === menuItem.to || location.pathname.endsWith(menuItem.to);
                  return (
                    <Link
                      key={idx}
                      to={menuItem.to}
                      className={`flex items-center py-2 px-3 rounded-md gap-3 ${
                        isActive
                          ? "bg-green-100 text-green-600 font-medium"
                          : "text-gray-600 hover:bg-green-100"
                      }`}
                    >
                      <menuItem.icon size={20} />
                      {probs.showLabels && (
                        <span className="text-md">{menuItem.label}</span>
                      )}
                    </Link>
                  );
                })}
              </nav>
            </div>
          </div>
        ))}
      </div>

      <footer className="border-t border-gray-200 py-3">
        <div className="flex items-center justify-center text-red-500 gap-5">
          <LogOut/>
          <button className="">Sign Out</button>
        </div>
        <div class="mt-auto pt-4 ">
          <div class="text-center py-2 text-xs text-gray-500">
            <span>Developed by</span>
            <a
              href="tel:+233541436414"
              class="mx-1 font-medium inline-flex items-center group"
            >
              <span class="text-green-600 group-hover:text-green-700 transition-colors">
                Gilbert Elikplim Kukah
              </span>
              <i class="ri-arrow-right-up-line ml-0.5 opacity-0 group-hover:opacity-100 transition-opacity"></i>
            </a>
            <span class="px-1 text-gray-300">|</span>
            <a
              href="tel:+233541436414"
              class="hover:text-blue-600 transition-colors"
            >
              0541436414
            </a>
          </div>
        </div>
      </footer>
    </div>
  );
};

export default CollectorSidebar;
