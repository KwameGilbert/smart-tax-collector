import React from "react";
import { useState } from "react";
import { Link, useLocation } from "react-router-dom";
import { Menu, X } from "lucide-react";
import { collectorsNavLinks } from "./CollectorNavLink";
const CollectorMobileNavbar = () => {
  const [isOpen, setIsOpen] = useState(false);
  const location = useLocation();

  return (
    <div className="md:hidden bg-blue-50 text-slate-700">
      <div className="flex justify-between items-center p-4 text-slate-700">
        <h2 className="text-gold text-xl font-bold">Finance Portal</h2>
        <button
          onClick={() => setIsOpen(!isOpen)}
          className="p-2 text-slate-700 rounded-md hover:bg-maroon-dark"
        >
          {isOpen ? <X size={24} /> : <Menu size={24} />}
        </button>
      </div>

      {isOpen && (
        <div className="fixed inset-0 bg-blue-50 z-50 pt-16">
          <button
            onClick={() => setIsOpen(false)}
            className="absolute top-4 right-4 p-2 text-slate-700"
          >
            <X size={24} />
          </button>

          {collectorsNavLinks.map((item, index) => (
            <nav className="px-4" key={index}>
              <h3 className="text-xs font-semibold text-slate-700 uppercase tracking-wider mb-5">
                {item.title}
              </h3>
              <ul>
                {item.menuItems.map((link) => {
                  const isActive = location.pathname === link.to;
                  return (
                    <li key={link.to}>
                      <Link
                        to={link.to}
                        className={`flex items-center px-4 py-3 rounded-lg transition-colors ${
                          isActive
                            ? "bg-blue-600 text-white font-medium"
                            : "text-slate-700 hover:bg-maroon-dark hover:text-gold"
                        }`}
                        onClick={() => setIsOpen(false)}
                      >
                        <span className="mr-3">
                          <link.icon />
                        </span>
                        <span>{link.label}</span>
                      </Link>
                    </li>
                  );
                })}
              </ul>
            </nav>
          ))}
        </div>
      )}
    </div>
  );
};

export default CollectorMobileNavbar;
