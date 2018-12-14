// pages/login/login.js
Page({

  /**
   * 页面的初始数据
   */
  data: {

  },

  /**
   * 生命周期函数--监听页面加载
   */
  onLoad: function (options) {
    wx.showLoading({ title: '加载中', })
    wx.login({
      success: function (res) {
        if (res.code) {
          //发起网络请求
          wx.request({
            url: 'https://www.liuzhengwei127.cn/GPASearching/Login.php',
            data: {
              code: res.code
            },
            method: 'GET',

            success: function (res) {
              console.log(res);
              if (res.data.flag == false) {
                wx.redirectTo({
                  url: '../binding/binding'
                })
                getApp().globalData.openid = res.data.openid;
              }
              if (res.data.flag == true) {
                getApp().globalData.studentName = res.data.studentName;
                getApp().globalData.studentID = res.data.studentID;
                getApp().globalData.score = res.data.score;
                getApp().globalData.scoreRank = res.data.scoreRank;
                getApp().globalData.credit = res.data.credit;
                getApp().globalData.updateTime = res.data.time;

                wx.redirectTo({
                  url: '../homepage/homepage'
                })
              }
            }
          })
        } else {
          console.log('登录失败！' + res.errMsg)
        }
      }
    });
  },
  /**
   * 生命周期函数--监听页面初次渲染完成
   */
  onReady: function () {
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