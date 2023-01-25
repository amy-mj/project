/** 
 * @description 검색 form
 */
const commonForm = {
    form     : {},
    thisForm : '',
    init     : function() {
        this.settingDatepicker();
        this.findForm();
    },
    settingDatepicker : function() { /* datepicker */
        $.datepicker.setDefaults({
            closeText           : "닫기",
            prevText            : "이전달",
            nextText            : "다음달",
            currentText         : "오늘",
            monthNames          : ["1월", "2월", "3월", "4월", "5월", "6월", "7월", "8월", "9월", "10월", "11월", "12월"],
            monthNamesShort     : ["1월", "2월", "3월", "4월", "5월", "6월", "7월", "8월", "9월", "10월", "11월", "12월"],
            dayNames            : ["일요일", "월요일", "화요일", "수요일", "목요일", "금요일", "토요일"],
            dayNamesShort       : ["일", "월", "화", "수", "목", "금", "토"],
            dayNamesMin         : ["일", "월", "화", "수", "목", "금", "토"],
            weekHeader          : "주",
            dateFormat          : "yy-mm-dd",
            firstDay            : 0,
            isRTL               : false,
            showMonthAfterYear  : true,
            yearSuffix          : "년"
        })
        let datepicker_option = {}
        if( $(".datepicker").hasClass("max") ) {
            datepicker_option.maxDate = 0;
        }
        $(".datepicker").datepicker(datepicker_option);
    },
    findForm : function() { /* form name이 있으면 name을 먼저 찾고, 없으면 id를 찾는다. 둘 다 없으면 form 태그를 저장 */
        let _self    = this;
        let form     = $(document).find("form");
        let formId   = form.attr("id");
        let formName = form.attr("name");

        _self.form   = {"name" : formName, "id" : formId};
        if(formName) {
            _self.thisForm = $(`form[name=${formName}]`);
        } else if(formId) {
            _self.thisForm = $(`#${formId}`);
        } else {
            _self.thisForm = form;
        }
    },
    validationByNull : function() { /* null check */
        let formElements  = this.thisForm[0];
        for(const el of formElements) {
            if(!el.value) {
                let label = el.parentElement.parentElement.querySelector('.title').innerText;
                alert(`${label} 을(를) 입력하세요!`);
                return 0;
            }
        }
        return 1;
    },
    reset : function() { /* 검색 초기화 */
        let _self = this;
        _self.thisForm[0].reset()
    }
}

/** 
 * @description 날짜 세팅
 */
const setDate = {
    defaultDate : function (defaultDate = 'today') { /* 기간 기본 세팅 */
        return this.period(defaultDate);
    },
    period : function (e) { /* 저번주, 이틀 전, 어제, 오늘, 이번주 날짜 세팅 */
        let period   = [];
        let today    = this.formatDate(); 
        let thisDate = new Date(); /* 저번주, 이번주 계산용 */
        let selector, thisBtn;

        if( e.currentTarget ) {
            selector    = e.currentTarget;
            thisBtn     = selector.dataset.id;
        } else {
            selector    = document.querySelector(`button[data-id=${e}]`);
            thisBtn     = e;
        }

        this._selectBtnCss(selector); /* 버튼 클릭 시 css class 토글 */
        
        switch(thisBtn) {
            case 'lastweek' :       /* 저번주 날짜 : 월요일 ~ 일요일 */
                let lastweek            = thisDate.getDay() + 6; 
                let lastweekStartDate   = new Date(thisDate.setDate(thisDate.getDate() - lastweek));
                let lastweekStart       = this.formatDate(lastweekStartDate);
                let lastweekEnd         = this.formatDate(new Date(lastweekStartDate.setDate(lastweekStartDate.getDate() + 6)));
                period                  = [lastweekStart, lastweekEnd];
                break;

            case 'two_days_ago' :   /* 그제 날짜 */
                let two_days_ago = this.formatDate(new Date(new Date().setDate(new Date().getDate() - 2)));
                period           = [two_days_ago, two_days_ago];
                break;

            case 'yesterday' :      /* 어제 날짜 */
                let yesterday = this.formatDate(new Date(new Date().setDate(new Date().getDate() - 1)));
                period        = [yesterday, yesterday];
                break;

            case 'today' :          /* 오늘 날짜 */
                period = [today, today];
                break;
            
            case 'two_days_after' : /* 모레 날짜 */
                let two_days_after = this.formatDate(new Date(new Date().setDate(new Date().getDate() + 2)));
                period             = [two_days_after, two_days_after];
                break;

            default :               /* 이번주 날짜(기본) : 월요일 ~ 오늘  */
                let thisWeekStartDate = new Date(thisDate.setDate(thisDate.getDate() - thisDate.getDay() + 1));
                let thisWeek          =  this.formatDate(thisWeekStartDate);
                period                = [thisWeek, today];
                break;
        }

        return period;
    },
    _selectBtnCss : function (e) {
        e.parentElement.querySelectorAll('button').forEach(function (el) {
            el.classList.remove('on');
        });
        e.classList.add('on');
    },
    formatDate : function (date = new Date()) { /* yy-mm-dd 포맷으로 반환 */
        const year  = date.getFullYear();
        const month = String(date.getMonth() + 1).padStart(2, '0');
        const day   = String(date.getDate()).padStart(2, '0');

        return [year, month, day].join('-');
    }
}

$("button.reset").on("click", function() { /* 검색 초기화 버튼 이벤트 */
    commonForm.reset();
});


$(function() {
    commonForm.init();
})