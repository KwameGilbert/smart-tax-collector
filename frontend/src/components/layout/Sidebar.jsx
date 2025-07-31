import React from "react";
import { Link } from "react-router-dom";
import { navLinks } from "../../../public/assets/data/NavLink";

const FinanceSidebar = (probs) => {
  return (
    <div
      className={`bg-blue-50 text-slate-700 h-screen flex-col justify-between duration-700 hidden md:flex ${
        probs.showLabels && "w-64 duration-500"
      }`}
    >
      {/* header */}
      <div className="p-4 mt-5">
        <div className="flex items-center gap-3">
          <h1 class="text-xl font-semibold">Finance Portal</h1>
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
                {item.menuItems.map((menuItem, idx) => (
                  <Link
                    key={idx}
                    to={menuItem.to}
                    className={`flex items-center py-2 px-3 rounded-md  gap-3 ${
                      window.location.pathname === menuItem.to
                        ? "bg-blue-600 text-white font-medium"
                        : "text-gray-600 hover:bg-blue-100"
                    }`}
                  >
                    <menuItem.icon size={20} />
                    {probs.showLabels && (
                      <span className="text-md">{menuItem.label}</span>
                    )}
                  </Link>
                ))}
              </nav>
            </div>
          </div>
        ))}
      </div>

      <footer>
        <div class="mt-auto pt-4 border-t border-gray-200">
          <div class="text-center py-2 text-xs text-gray-500">
            <span>Developed by</span>
            <a
              href="tel:+233541436414"
              class="mx-1 font-medium inline-flex items-center group"
            >
              <span class="text-blue-600 group-hover:text-blue-700 transition-colors">
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

export default FinanceSidebar;
