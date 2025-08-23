import React from "react";
import { Link, useLocation } from "react-router-dom";
import { navLinks } from "./NavLinks";

const FinanceSidebar = (probs) => {
  const location = useLocation();
  return (
    <div
      className={`bg-white text-slate-900 h-screen flex-col justify-between duration-700 hidden md:flex ${
        probs.showLabels && "w-64 duration-500"
      }`}
    >
      {/* header */}
      <div className="p-4 mt-5">
        <div className="flex items-center gap-3">
          <h1 className="text-xl font-semibold">Executive Portal</h1>
        </div>
      </div>

      {/* navigation */}
      <div className="flex-1 p-4">
        {/* main section */}
        {navLinks.map((item, index) => (
          <div className="mb-6" key={index}>
            <div>
              {probs.showLabels && (
                <h3 className="text-sm uppercase tracking-wider text-gray-500 font-semibold mb-2">
                  {item.title}
                </h3>
              )}
              <nav className="space-y-4">
                {item.menuItems.map((menuItem, idx) => {
                  // Use location.pathname for active state (updates immediately on navigation)
                  const isActive = location.pathname === menuItem.to || location.pathname.endsWith(menuItem.to);
                  return (
                    <Link
                      key={idx}
                      to={menuItem.to}
                      className={`flex items-center py-2 px-3 rounded-md gap-3 ${
                        isActive
                          ? "bg-orange-600 text-white font-medium shadow"
                          : "text-gray-800 hover:bg-orange-100"
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

      <footer>
        <div className="mt-auto pt-4 border-t border-gray-200">
          <div className="text-center py-2 text-xs text-gray-500">
            <span>Developed by</span>
            <a
              href="tel:+233541436414"
              className="mx-1 font-medium inline-flex items-center group"
            >
              <span className="text-blue-600 group-hover:text-blue-700 transition-colors">
                Gilbert Elikplim Kukah
              </span>
              <i className="ri-arrow-right-up-line ml-0.5 opacity-0 group-hover:opacity-100 transition-opacity"></i>
            </a>
            <span className="px-1 text-gray-300">|</span>
            <a
              href="tel:+233541436414"
              className="hover:text-blue-600 transition-colors"
            >
              0541436414
            </a>
          </div>
        </div>
      </footer>
    </div>
  );
};

export default FinanceSidebar;
