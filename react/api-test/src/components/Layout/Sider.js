/*
 * @Author: Lix 
 * @Date: 2018-04-04 10:59:04 
 * @Last Modified by: Lix
 * @Last Modified time: 2018-04-04 15:18:59
 */

import React, { Component } from 'react';
import { Menu, Icon, Layout } from 'antd';
import { Link } from 'react-router-dom';
const SubMenu = Menu.SubMenu;
const { Sider } = Layout;

class SliderView extends Component {
  render() {
    return (
      <Sider width={200} style={{ background: '#fff' }} >
        <Menu
          mode="inline"
          defaultOpenKeys={['sub1']}
          defaultSelectedKeys={['1']}
          style={{ height: '100%', borderRight: 0 }}
          theme="dark"
        >
          <SubMenu key="sub1" title={<span><Icon type="laptop" />API列表</span>}>
            <Menu.Item key="1"><Link to="/app/uploadpath">上传图片路径</Link></Menu.Item>
            <Menu.Item key="2"><Link to="/app/imgCompress">压缩图片</Link></Menu.Item>
            <Menu.Item key="3"><Link to="/app/square">广场动态</Link></Menu.Item>
          </SubMenu>
        </Menu>
      </Sider>
    );
  }
}

export default SliderView;
