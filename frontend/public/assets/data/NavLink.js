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
      { icon: ChartNoAxesColumn, label: "Revenue Overview", to: "/finance" },
      { icon: Building2, label: "Business Registry", to: "business-registry" },
      { icon: Bell, label: "Notification Center", to: "notification-center" },
      { icon: CircleDollarSign, label: "Payments", to: "payment-management" },
      { icon: UserStar, label: "Tax Collectors", to: "collectors-management" },
      { icon: FileChartColumn, label: "Reports", to: "reports" },
      { icon: Settings, label: "Settings", to: "settings" },
    ],
  },
];


