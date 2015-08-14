/**
 * js对象
 * 1.使用构造函数来添加属性
 * 2.使用原型来添加方法
 * 3.使用new来实例化对象
 * 
 * 公共js文件
 * @datetime 15-8-15 上午1:06
 * @author dzlin
 */

//TOOD
//这里需要初始化客户端浏览器的可见width和height
//并且窗口大小改变时，这里的值也要跟着改变
//也需要知道客户端屏幕分辨率
//和使用的浏览器

/**
 * 
 * @param {type} width
 * @param {type} height
 * @returns {Common}
 */
function Common(width, height)
{
    this.width = width;
    this.height = height;
}

Common.prototype.getWidth = function ()
{
    return this.width;
};

Common.prototype.getHeight = function ()
{
    return this.height;
};