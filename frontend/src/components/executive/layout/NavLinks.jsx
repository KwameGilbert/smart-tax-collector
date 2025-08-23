import {
  Calendar,
  Users,
  FileChartColumn,
  Building2,
  Settings,
  Bell,
  UserStar,
  ChartNoAxesColumn,
  CircleDollarSign,
} from "lucide-react";

export const navLinks = [
  {
    title: "MANAGEMENT",
    menuItems: [
      { icon: ChartNoAxesColumn, label: "Dashboard", to: "/executive" },
      { icon: CircleDollarSign, label: "Reports", to: "revenue-reports" },
      { icon: Bell, label: "Analytics", to: "analytics" },
      { icon: UserStar, label: "Taxpayer", to: "collectors-management" },
      { icon: FileChartColumn, label: "Department Reports", to: "department-reports" },
      { icon: Settings, label: "Settings", to: "settings" },
    ],
  },
];

