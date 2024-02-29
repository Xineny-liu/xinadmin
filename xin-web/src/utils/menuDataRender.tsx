import React from 'react';
import { MenuDataItem } from '@ant-design/pro-components';
import * as AntdIcons from "@ant-design/icons";
import IconFont from '@/components/IconFont';
const allIcons: { [key: string]: any } = AntdIcons;
// 从接口获取菜单时icon为string类型
const fixMenuItemIcon = (menus: MenuDataItem[]): MenuDataItem[] => {
  menus.forEach((item) => {
    if(item.icon && typeof item.icon === 'string' && allIcons[item.icon]){
      if (item.icon.startsWith('icon-')) {
        item.icon = <IconFont type={item.icon} className={item.icon} />;
      } else {
        item.icon = React.createElement(allIcons[item.icon]);
      }
    }
    // TODO 二级菜单暂时不可通过此方式解决图标无法渲染问题，等待 Umi 官方更新
    // if(item.children && item.children.length > 0){
    //   item.children = fixMenuItemIcon(item.children)
    // }
  });

  return menus;
};

export default fixMenuItemIcon;
