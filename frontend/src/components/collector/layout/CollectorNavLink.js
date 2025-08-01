import { Settings, Bell, Building2, ChartNoAxesColumn, CircleDollarSign } from "lucide-react";

export const collectorsNavLinks = [
  {
    title: "Main",
    menuItems: [
      { icon: ChartNoAxesColumn, label: "Dashboard", to: "/collector" },
      { icon: Building2, label: "Search Business", to: "search-business" },
      { icon: Bell, label: "My Collections", to: "collections" },
      { icon: CircleDollarSign, label: "Performance", to: "performance" },
      { icon: Settings, label: "Settings", to: "/calendar" },
    ],
  },
];
