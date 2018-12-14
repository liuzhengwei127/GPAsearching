// pages/score/score.js
Page({

  /**
   * 页面的初始数据
   */
  data: {
    Name: '',
    ID: '',
    score: '',
    scoreRank:'',
    credit:'',
    updateTime:''
},
_about:function()
{
  wx.showModal({
    title:'关于',
    content: '1.本系统是上海交通大学软件学院成绩查询系统\r\n 2.成绩数据来源自教务处',
    showCancel: false,
    success: function (res) {
      if (res.confirm) {
        console.log('用户点击确定')
      }
    }
  })
},
  _help: function () {
    wx.showModal({
      title: '帮助',
      content: ' 1.该系统仅支持软件学院学生查询成绩及学积分排名\r\n2.如果查询不到成绩，请询问相关老师是否已经导入系统\r\n3.若个人信息有误请发邮件至1161574611@qq.com',
      showCancel: false,
      success: function (res) {
        if (res.confirm) {
          console.log('用户点击确定')
        }
      }
    })
  },
  _privacy: function () {
    wx.showModal({
      title: '隐私说明',
      content: ' 1.仅允许学生通过微信号进行一对一绑定，查询学生本人成绩\r\n2.本系统不会将成绩信息透露给他人',
      showCancel: false,
      success: function (res) {
        if (res.confirm) {
          console.log('用户点击确定')
        }
      }
    })
  },
 

  /**
   * 生命周期函数--监听页面加载
   */
  onLoad: function (options) {
    wx.showLoading({ title: '加载中', })
    this.setData ({
      Name: getApp().globalData.studentName,
      ID: getApp().globalData.studentID,
      score: getApp().globalData.score,
      scoreRank:getApp().globalData.scoreRank,
      credit:getApp().globalData.credit,
      updateTime:getApp().globalData.updateTime
    });
  },

  /**
   * 生命周期函数--监听页面初次渲染完成
   */
  onReady: function () {
    wx.hideLoading() 

  },

  /**
   * 生命周期函数--监听页面显示
   */
  onShow: function () {

  },

  /**
   * 生命周期函数--监听页面隐藏
   */
  onHide: function () {

  },

  /**
   * 生命周期函数--监听页面卸载
   */
  onUnload: function () {

  },

  /**
   * 页面相关事件处理函数--监听用户下拉动作
   */
  onPullDownRefresh: function () {

  },

  /**
   * 页面上拉触底事件的处理函数
   */
  onReachBottom: function () {

  },

  /**
   * 用户点击右上角分享
   */
  onShareAppMessage: function () {

  }
})