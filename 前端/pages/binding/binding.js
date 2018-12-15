// pages/binding/binding.js
Page({
 
  /**
   * 页面的初始数据
   */
  data: {
    studentName:'',
    studentID:''
  },

  /**
   * 点击绑定
   */
  studentName_input:function(e){
    this.setData({
      studentName:e.detail.value
    })
  }
 ,
  studentID_input: function (e) {
    this.setData({
      studentID: e.detail.value
    })
  }
  ,
  
  bindClick: function(){
    
    if(this.data.studentName.length==0||this.data.studentID.length!=12){
      wx.showModal({
        content: '姓名或学号格式错误！',
        showCancel: false,
        success: function (res) {
          if (res.confirm) {
            console.log('用户点击确定')
          }
        }
      })
    }
    else{
      var that=this;
      
      wx.request({
        url: 'https://www.liuzhengwei127.cn/Binding.php',
        data:{
          studentName:this.data.studentName,
          studentID:this.data.studentID,
          openid:getApp().globalData.openid,
        },
        method:'GET',
        
        success: function (res) {
          console.log(getApp().globalData.openid);
          console.log(res);
          console.log(res.data.status_code);
          switch(res.data.status_code)
          {
            case 0:
              {
                wx.showToast({
                title: '绑定成功',
                icon: 'success',
                duration: 3000,
                })
                getApp().globalData.studentName = res.data.studentName;
                getApp().globalData.studentID = res.data.studentID;
                getApp().globalData.score = res.data.score;
                getApp().globalData.openid = res.data.openid;
                wx.redirectTo({
                url: '../homepage/homepage'
                })
              };break;
            case 1:
            {
                wx.showModal({
                  content: '绑定失败，请检查学号姓名输入正确或者老师已上传成绩',
                  showCancel: false,
                  success: function (res) {
                    if (res.confirm) {
                      console.log('用户点击确定')
                    }
                  }
                })
              }; break;
            case 2:
              {
                wx.showModal({
                  content: '用户已被绑定',
                  showCancel: false,
                  success: function (res) {
                    if (res.confirm) {
                      console.log('用户点击确定')
                    }
                  }
                })
              }; break;
            case 3:
              {
                wx.showModal({
                  content: '绑定失败，请确认学号姓名输入正确或老师已上传成绩',
                  showCancel: false,
                  success: function (res) {
                    if (res.confirm) {
                      console.log('用户点击确定')
                    }
                  }
                })
              }; break;
            case 4:
              {
                wx.showModal({
                  content: '数据库操作失败',
                  showCancel: false,
                  success: function (res) {
                    if (res.confirm) {
                      console.log('用户点击确定')
                    }
                  }
                })
              }; break;
            case 5:
              {
                wx.showModal({
                  content: '数据库连接失败',
                  showCancel: false,
                  success: function (res) {
                    if (res.confirm) {
                      console.log('用户点击确定')
                    }
                  }
                })
              }; break;
            default:
              {
                wx.showModal({
                  content: '未知错误',
                  showCancel: false,
                  success: function (res) {
                    if (res.confirm) {
                      console.log('用户点击确定')
                    }
                  }
                })
              }; break;
          }
        } 
      })
    }
  }
  ,

  help: function () {
    wx.showModal({
      title: '帮助',
      content: ' 如有任何问题请发送邮件至1161574611@qq.com',
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
    wx.showModal({
      title: '绑定说明',
      content: ' 一个微信号绑定一名学生，一旦绑定无法解绑，请确认绑定的是您本人！',
      showCancel: false,
      success: function (res) {
        if (res.confirm) {
          console.log('用户点击确定')
        }
      }
    })

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