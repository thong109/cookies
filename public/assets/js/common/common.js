/**
 * ****************************************************************************
 *
 COMMON CODE
 * COMMON.JS
 *
 * description		:	Các phương thức và sự kiện chung hay xử lý trong web
 * created at		:	2018/07/07
 * created by		:
 –
09@gmail.com
 * package		    :	COMMON
 * copyright	    :	Copyright (c)

 * version		    :	1.0.0
 * ****************************************************************************
 */

/**
 * Các giá trị tùy chỉnh cho datetimepicker
 * @typedef {Object} DatetimePickerOption
 * @property {string} [format] Định dạng ngày tháng nhập vào (ví dụ: DD/MM/YYYY)
 * @property {number} [minDate] Số năm nhỏ nhất có thể chọn
 * @property {number} [maxDate] Số năm lớn nhất có thể chọn
 * @property {boolean} [allowInputToggle] CHo phép đoáng picker khi click ngoài input
 */

/**
 * Các giá trị quy định thuộc tính của thẻ HTML trên màn hình
 * @typedef {Object} AttributeOfItem
 * @property {number} [maxlength] Độ dài tối đa có thể nhập vào
 * @property {number} [minlength] Độ dài tối thiểu có thể nhập vào
 * @property {number} [decimal] Số chữ số thập phân có thể nhập
 * @property {boolean} [readonly] Input chỉ có thể đọc
 * @property {boolean} [disabled] Disable input
 * @property {number} [tabindex] Tabindex của Item
 * @property {boolean} [not_check] Không check validate cho item này
 * @property {number} [gt] Giá trị nhập vào phải lớn hơn giá trị này
 * @property {number} [gz] Giá trị nhập vào phải nhỏ hơn giá trị này
 * @property {boolean} [noname] Không set lại giá trị name cho item
 * @property {string} [class] Class của css sẽ add thêm vào item này
 */

/**
 * Chứa định nghĩa và các yêu cầu validate cho item trên màn hình
 * @typedef {Object} ItemHtml
 * @property {string} type Loại của item trên màn hình
 * @property {AttributeOfItem} [attr] Các thuộc tính quy định của item
 */

/**
 * Hàm callback sẽ thực hiện sau khi tương tác (click ok hay cancel) trên popup thông báo
 * Nếu click ok - giá rị tham số là true
 * Nếu click cancel - giá trị tham số là false
 *
 * @callback NotifyCallback
 * @param {boolean} ok Người dùng click đồng ý hay không đồng ý trên popup thông báo
 */

/**
 * Hàm callback sẽ thực hiện sau khi lấy được private IP của máy
 *
 * @callback CallbackAfterHaveIP
 * @param {string} myIP private IP của máy người dùng
 */

/**
 * Dữ liệu json trả về từ server
 * @typedef {Object} ResponseInfo
 * @property {number} Code Mã kết quả của request
 * 200: Thành công
 * 201: Lỗi dữ liệu nhập vào
 * 202: Có lỗi khác phát sinh
 * 403: Không có quyền truy cập
 * 500: Lỗi server
 * @property {string} MsgNo Mã của thông báo sẽ hiển thị
 * @property {...Object<string, string>} ListError Danh sách lỗi nếu có
 * @property {...Object<string, string>} Data Dữ liệu bổ sung tùy mỗi request
 */

/** Các hằng số sẽ dùng chung trong hệ thống */
const CONSTANTS = {
    /**
     * Cấu hình cho datetime picker
     * @type {DatetimePickerOption}
     */
    DATE_OPTION: { format: 'DD/MM/YYYY', minDate: 1975, maxDate: 9999, allowInputToggle: true },
    /**
     * Cấu hình cho datetime picker chỉ chọn tháng và năm
     * @type {DatetimePickerOption}
     */
    YM_OPTION: { format: 'MM/YYYY', minDate: 1975, maxDate: 9999, allowInputToggle: true },
    /**
     * Cấu hình cho datetime picker chỉ chọn thời gian
     * @type {DatetimePickerOption}
     */
    TIME_OPTION: { format: 'HH:mm', allowInputToggle: true },
    /** Loại thông báo xác nhận 1 hành động nào đó */
    CONFIRM: 1,
    /** Loại thông báo thực hiện thành công 1 hành động nào đó */
    SUCCESS: 2,
    /** Loại thông báo cảnh báo 1 hành động nguy hiểm */
    WARNING: 3,
    /** Loại thông báo lỗi */
    ERROR: 4,
    /** Loại thông báo 1 thông tin nào đó ra màn hình */
    INFO: 5,
    /** Loại thông báo 1 thông tin nào đó ra màn hình */
    ALERT: 6,
    /** Chế độ trên màn hình */
    MODE: {
        INSERT: 'I',
        UPDATE: 'U'
    },
    /** Trạng thái tài khoản */
    ACCOUNT_STATUS: {
        USING: 10,
        LOCK: 20
    },
    /** Trạng thái active/unactive tài khoản */
    ACCOUNT_ACTIVE: {
        ACTIVE: 1,
        UNACTIVE: 0
    },
    TEAM_ACTIVE: {
        ACTIVE: 1,
        UNACTIVE: 0
    },
    BLOG_STATUS:{
        DRAFT: 10,
        PUBLISHED:20
    },
    /** Trạng thái slide */
    SLIDE_STATUS:{
        UNACTIVE:0,
        ACTIVE:1
    },
    /** Trạng thái recomment của plan */
    PLAN_RECOMMENT: {
        ACTIVE: 1,
        UNACTIVE: 0
    },
    /** type của plan */
    PLAN_TYPE: {
        PERSONAL: 10,
        COMPANY: 20
    },
    /** Trạng thái plan */
    PLAN_STATUS: {
        ACTIVE: 1,
        UNACTIVE: 0
    },
    /** Trạng thái client */
    CLIENT_STATUS: {
        ACTIVE: 1,
        UNACTIVE: 0
    },
    /** Trạng thái partner */
    PARTNER_STATUS:{
        UNACTIVE:0,
        ACTIVE:1
    },
     /** Trạng thái hình ảnh */
     GALLERY_STATUS: {
        ACTIVE: 1,
        UNACTIVE: 0
    },
    /** Size ảnh (10Mb)*/
    IMAGE_SIZE: 10 * 1024 * 1024,
    /** password mặc định */
    DEFAULT_PASSWORD: '********',
     /** Trạng thái video */
    VIDEO_STATUS: {
        ACTIVE: 20,
        UNACTIVE: 10
    },
};
var DISABLE_LOADING = false;
$(document).ready(function () {
    NumberModule.InitEvents();
    DateModule.InitEvents();
    TimeModule.InitEvents();
    StringModule.InitEvents();
    ValidateModule.InitEvents();
    Common.InitEvents();
    // Common.DisableFunction(true);
    RefreshToken();
    $('.set-culture').on('click', function () {
        var $lang = $(this);
        $.ajax({
            type: 'post',
            url: $(this).attr('link'),
            dataType: 'json',
            data: {
                culture: $lang.attr('lang')
            },
            global: false,
            success: function (res) {
                window.location = window.location;
            },
            error: function (res) {
            }
        });
    });
    $('.btn-logout').on('click', function (e) {
        e.preventDefault();
        $.ajax({
            type: 'get',
            url: $(this).attr('link'),
            success: function (res) {
                $.removeCookie('token');
                $.removeCookie('refreshToken');
                $.removeCookie('expires');
                window.location = '/';
            },
            error: function (res) {
            }
        });
    });
});

var RefreshToken = function () {
    try {
        // setInterval(function () {
        //     DoRefreshToken();
        // }, 1000);
    }
    catch (e) {
        console.log('RefreshToken: ' + e.message);
    }
}

var REFRESHING_TOKEN = false;
var DoRefreshToken = function () {
    try {
        var token = $.cookie('token');
        if (!StringModule.IsNullOrEmpty(token) && !REFRESHING_TOKEN && commonUrl.refreshToken) {
            var expiresFrom = new Date($.cookie('expires'));
            expiresFrom.setTime(expiresFrom.getTime() - (60 * 1000));
            var expiresTo = new Date($.cookie('expires'));
            var now = new Date();
            if (now >= expiresFrom && now <= expiresTo) {
                REFRESHING_TOKEN = true;
                $.ajax({
                    type: 'get',
                    url: commonUrl.refreshToken,
                    dataType: 'json',
                    global: false,
                    success: function (res) {
                        if (res.code === 200) {
                            $.cookie('token', res.data.token, { expires: 1, path: '/' });
                            $.cookie('refreshToken', res.data.refreshToken, { expires: 1, path: '/' });
                            var date = new Date();
                            date.setTime(date.getTime() + (NumberModule.ToNumber(res.data.expires) * 60 * 1000));
                            $.cookie('expires', date.toUTCString(), { expires: 1, path: '/' });
                        }
                        REFRESHING_TOKEN = false;
                    },
                    error: function () {
                        REFRESHING_TOKEN = false;
                    }
                });
            }
        }
    }
    catch (e) {
        REFRESHING_TOKEN = false;
        console.log('DoRefreshToken: ' + e.message);
    }
}

/*********************************/
/**          Module Number       */
/*********************************/

/**
 * Module chứa các xử lý liên quan đến dữ liệu số
 * Thêm class numeric để nhập số nguyên, class decimal để nhập số thực
 * Đối với việc nhập số thực có thể tùy chọn các tham số sau:
 * - negative (true hoặc false): cho phép nhập số âm hay không
 * - decimal: số chữ số thập phân có thể nhập
 * - maxlength: chiều dài tối đa của ký tự, có kể dấu chấm thập phân, không kể đến các dấu phẩy phân tách group chữ số
 *
 * Author       :
 - 2018/07/07 - create
 *
 * Output       :   NumberModule.InitEvents() - Khởi tạo các sự kiện liên quan đến dữ liệu số
 * Output       :   NumberModule.OnlyTypeNumber(event) - Chỉ cho phép nhập số nguyên vào 1 item
 * Output       :   NumberModule.OnlyTypeDecimal(event) - Cho phép nhập số thực vào 1 item
 * Output       :   NumberModule.MakeValueWithDecimalFormat(event) - Chuyển về số thực theo định dạng ngay trong quá trình nhập
 * Output       :   NumberModule.InsertCommaToGroupNumber($input) - Chèn thêm dấu phẩy phân tách mỗi 3 số với nhau
 * Output       :   NumberModule.ToNumber(string) - Đổi từ chỗi sang số
 * Output       :   NumberModule.ValidateNumber(string) - Kiểm tra 1 giá trị đầu vào có phải là số không
 */
var NumberModule = (function () {
    /**
     * Khởi tạo các sự kiện liên quan đến dữ liệu số
     *
     * Author :
 - 2018/07/07 - create
     */
    var InitEvents = function () {
        // Sự kiện nhấn phím cho item nhập 1 số nguyên dương
        $(document).on('keydown', 'input.numeric:enabled, input.only-number:enabled', function (event) {
            OnlyTypeNumber(event);
        });
        // Sự kiện nhấn phím cho item nhập 1 số thực
        $(document).on('keydown', 'input.decimal:enabled', function (event) {
            OnlyTypeDecimal(event);
            MakeValueWithDecimalFormat(event);
        });
        // Sự kiện khi blur ra khỏi item nhập số thực hoặc số nguyên dương
        $(document).on('blur', 'input.decimal,input.numeric', function () {
            InsertCommaToGroupNumber($(this));
        });
        // Sự kiện khi focus vào 1 ô nhập tiền hay số
        $(document).on('focus', 'input.decimal,input.numeric', function () {
            // Bỏ các dấu phân cách 3 chữ số
            $(this).val($(this).val().replace(/\./g, ''));
        });
        $(document).on('blur', 'input.only-number', function () {
            $(this).val($(this).val().replace(/\D+/g, ""));
        });
    };

    /**
     * Chỉ cho phép nhập ký tự số cho sự kiện nhấn phím
     *
     * Author :
 - 2018/07/07 - create
     * @param {object} event Sự kiện nhập phím
     * @returns {boolean} true nếu phím được nhập, false nếu phím không được phép nhập
     */
    var OnlyTypeNumber = function (event) {
        try {
            if (
                !(
                    (event.keyCode > 47 && event.keyCode < 58) // 0 ~ 9
                    || (event.keyCode > 95 && event.keyCode < 106) // numpad 0 ~ 9
                    || event.keyCode === 116 // F5
                    || event.keyCode === 46 // del
                    || event.keyCode === 35 // end
                    || event.keyCode === 36 // home
                    || event.keyCode === 37 // ←
                    || event.keyCode === 39 // →
                    || event.keyCode === 8 // backspace
                    || event.keyCode === 9 // tab
                    || (event.shiftKey && event.keyCode === 35) // shift + end
                    || (event.shiftKey && event.keyCode === 36) // shift + home
                    || event.ctrlKey // allow all ctrl combination
                )
                || (event.shiftKey && (event.keyCode > 47 && event.keyCode < 58)) // exlcude Shift + [0~9] (ký tự thứ 2 trên phím số)
            ) {
                event.preventDefault();
                return false;
            }
            return true;
        }
        catch (e) {
            console.log('OnlyTypeNumber: ' + e.message);
            return false;
        }
    };

    /**
     * Chỉ cho phép nhập ký tự số phục vụ số thực cho sự kiện nhấn phím
     *
     * Author :
 - 2018/07/07 - create
     * @param {object} event Sự kiến ấn phím
     * @return {boolean} true nếu phím được nhập, false nếu phím không được phép nhập
     */
    var OnlyTypeDecimal = function (event) {
        try {
            if (
                !(
                    (event.keyCode > 47 && event.keyCode < 58) // 0-9
                    || (event.keyCode > 95 && event.keyCode < 106) // 0-9 (numlock)
                    // . và . (numlock), chỉ dc nhập 1 dấu chấm thập phân
                    || ((event.keyCode === 190 || event.keyCode === 110) && $(event.target).val().indexOf('.') === -1)
                    || event.keyCode === 173 // - (di động)
                    || event.keyCode === 109 // - (numlock)
                    || event.keyCode === 189 // -
                    || event.keyCode === 116 // F5
                    || event.keyCode === 46 // Delete
                    || event.keyCode === 8 // Backspace
                    || event.keyCode === 9 // Tab
                    || event.keyCode === 229 // phím số trên di động
                    // Ctrl + A, C, X, V
                    || ($.inArray(event.keyCode, [65, 67, 86, 88, 116]) !== -1 && event.ctrlKey === true)
                    // Sift + Tab
                    || ($.inArray(event.keyCode, [9]) !== -1 && event.shiftKey === true)
                    // End, Home, Left, Right
                    || (event.keyCode >= 35 && event.keyCode <= 39)
                )
                || (event.shiftKey && (event.keyCode > 47 && event.keyCode < 58)) // exlcude Shift + [0~9] (ký tự thứ 2 trên phím số)
            ) {
                event.preventDefault();
                return false;
            }
            return true;
        }
        catch (e) {
            console.log('OnlyTypeDecimal: ' + e.message);
            return false;
        }
    };

    /**
     * Chuyển về số thực theo định dạng ngay trong quá trình nhập số.
     * Đối với việc nhập số thực có thể tùy chọn các tham số sau:
     * - negative (true hoặc false): cho phép nhập số âm hay không
     * - decimal: số chữ số thập phân có thể nhập
     *
     * Author :
 - 2018/07/07 - create
     * @param {object} event Sự kiến ấn phím
     */
    var MakeValueWithDecimalFormat = function (event) {
        try {
            var $input = $(event.target);
            // Kiểm tra xem có cho nhập số âm hay không
            var negativeEnabled = $input.attr('negative');
            // Nếu chỉ nhập phim số bình thường và phấm dấu .
            if (event.keyCode !== 116 // F5
                && event.keyCode !== 46 // Delete
                && event.keyCode !== 37 // Left
                && event.keyCode !== 39 // Right
                && event.keyCode !== 8 // Backspace
                && event.keyCode !== 9 // Tab
                && event.keyCode !== 173 // - (di động)
                && event.keyCode !== 189 // - (numlock)
                && event.keyCode !== 109 // -
                // Đang có con trỏ chuột trong phần text
                && ($input.get(0).selectionEnd - $input.get(0).selectionStart) < $input.val().length
            ) {
                // Định dạng mặc định (decimal (10, 0))
                /** Số ký tự phần nguyên */
                var ml = 10;
                /** Số ký tự phần thập phân */
                var dc = 0;
                if (parseInt($input.attr('maxlength')) * 1 > 2) {
                    // Lấy phần số nguyên bằng maxlength có thể nhập
                    ml = 1 * $input.attr('maxlength');
                }
                // Lấy quy định về số phàn thập phân
                if (parseInt($input.attr('decimal')) > 0) {
                    // Lấy số chữ số thập phân có thể nhập
                    dc = 1 * $input.attr('decimal');
                    // Nếu số lượng số thập phân lớn hơn phần nguyên có thể nhập thì cho về 0
                    if (dc >= ml - 1) {
                        dc = 0;
                    }
                }
                /** Số chữ số phần nguyên có thể nhập để đúng maxlength (trừ đi số ký tự dùng để nhập dấu chấm và phần thập phân) */
                var it = (ml - (dc > 0 ? (dc + 1) : 0));
                // Lấy lại trạng thái hiện tại của item đang nhập
                /** Giá trị hiện tại */
                var val = $input.val();
                /** Có đang nhập số âm không */
                var negative = val.indexOf('-') > -1;
                /** vị trí bắt đầu của con trỏ */
                var selectionStart = $input.get(0).selectionStart;
                /** vị trí kết thúc của con trỏ */
                var selectionEnd = $input.get(0).selectionEnd;
                // Nếu đang là số âm thì tạm thời bỏ dấu âm đi để xử lý
                // sau này sẽ thêm lại vào sau
                if (negative) {
                    val = val.substring(1);
                    // Dịch chuyển đoạn text đang chọn đến trước 1 ký tự
                    selectionStart--;
                    selectionEnd--;
                }
                // Tính toán trạng thái mới cho item
                /** Vị trí bắt đầu chọn mới */
                var destSelectionStart = undefined;
                /** Vị trí kết thúc chọn mới */
                var destSelectionEnd = undefined;
                /** Giá trị mới */
                var destVal = undefined;
                // Nếu giá trị phần thập phân = 0 thì bỏ qua việc nhập ký tự dấu chấm.
                if (dc === 0 && (event.keyCode === 190 || event.keyCode === 110)) {
                    event.preventDefault();
                }
                // Nếu đã nhập đủ số lượng chữ số nguyên
                if (val.match(new RegExp('[0-9]{' + it + '}')) && selectionStart <= it) {
                    // Nếu chưa có dấu thập phân
                    if (val.indexOf('.') === -1) {
                        // Và ký tự hiện tại khoogn phải là dấu chấm phân cách thập phân (người dùng quên nhập dấu thập phân)
                        if (event.keyCode !== 190 && event.keyCode !== 110 && dc > 0) {
                            event.preventDefault();
                            // Thêm ký tự chấm thập phân phù hợp với định dạng yêu cầu
                            /** Chuỗi giá trị mới sau khi đã thêm ký tự mới nhập vào */
                            var output = '';
                            // Nếu nhập từ numlock
                            if (event.keyCode >= 96 && event.keyCode <= 105) {
                                // thì đưa về mã munber chính để chèn vào vị trí đang đặt con trỏ
                                output = val.substring(0, selectionStart) + String.fromCharCode(event.keyCode - 48) + val.substring(selectionStart);
                                // Tách ra phần nguyên và thập phân để chèn dấu chấm vào giữa
                                destVal = output.substring(0, ml - (dc + 1)) + '.' + output.substring(ml - (dc + 1));
                            }
                            // Nếu nhập từ mobile
                            else if (event.keyCode === 229) {
                                // nếu là phím số thì chèn vào vị trí đang đặt con trỏ
                                if ($.inArray(event.key, ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9']) !== -1) {
                                    output = val.substring(0, selectionStart) + event.key + val.substring(selectionStart);
                                }
                                // Tách ra phần nguyên và thập phân để chèn dấu chấm vào giữa
                                if (output.substring(ml - (dc + 1)) !== '') {
                                    destVal = output.substring(0, ml - (dc + 1)) + ',' + output.substring(ml - (dc + 1));
                                }
                                // Nếu không có phần thập phân thì không chèn dấu chấm
                                else {
                                    destVal = output.substring(0, ml - (dc + 1));
                                }
                            }
                            // Nếu là nhập phím số bình thướng
                            else {
                                // chèn vào vị trí đang đặt con trỏ
                                output = val.substring(0, selectionStart) + String.fromCharCode(event.keyCode) + val.substring(selectionStart);
                                // Tách ra phần nguyên và thập phân để chèn dấu chấm vào giữa
                                destVal = output.substring(0, ml - (dc + 1)) + ',' + output.substring(ml - (dc + 1));
                            }
                        }
                    }
                    // Nếu vị trí con trỏ đang nằm liền trước dấu thập phân
                    else if (selectionStart === val.indexOf(',')) {
                        // Nếu đã đủ phần thập phân thì không cho nhập nữa
                        if (val.match(new RegExp('\\,[0-9]{' + dc + '}$'))) {
                            event.preventDefault();
                        } else {
                            // Nếu đủ thì chèn ký tự đang nhập vào vị trí tiếp theo sau dấu thập phân
                            destSelectionStart = selectionStart + 1;
                        }
                    }
                    // Nếu vị trí con trỏ đang nằm liền trước dấu thập phân
                    else if (selectionStart < val.indexOf(',') && selectionStart === selectionEnd) {
                        event.preventDefault();
                        // vì đã đủ phần nguyên nên sẽ không cho nhập nữa
                    }
                    // Nếu bôi dn đoạn text có chứa dấu chấm thập phân
                    else if (selectionEnd > val.indexOf(',') && selectionStart < val.indexOf(',')) {
                        event.preventDefault();
                        // Thêm ký tự chấm thập phân phù hợp với định dạng yêu cầu
                        /** Chuỗi giá trị mới sau khi đã thêm ký tự mới nhập vào */
                        var output = '';
                        // Nếu nhập từ numlock
                        if (event.keyCode >= 96 && event.keyCode <= 105) {
                            // thì đưa về mã munber chính để chèn thay thế đoạn bôi đen
                            output = val.substring(0, selectionStart) + String.fromCharCode(event.keyCode - 48) + val.substring(selectionEnd);
                            // Tách ra phần nguyên và thập phân để chèn dấu chấm vào giữa
                            destVal = output.substring(0, ml - (dc + 1)) + ',' + output.substring(ml - (dc + 1));
                        }
                        // Nếu nhập từ mobile
                        else if (event.keyCode === 229) {
                            // nếu là phím số thì chèn vào vị trí đang đặt con trỏ
                            if ($.inArray(event.key, ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9']) !== -1) {
                                output = val.substring(0, selectionStart) + event.key + val.substring(selectionStart);
                            }
                            // Tách ra phần nguyên và thập phân để chèn dấu chấm vào giữa
                            if (output.substring(ml - (dc + 1)) !== '') {
                                destVal = output.substring(0, ml - (dc + 1)) + ',' + output.substring(ml - (dc + 1));
                            }
                            // Nếu không có phần thập phân thì không chèn dấu chấm
                            else {
                                destVal = output.substring(0, ml - (dc + 1));
                            }
                        }
                        // Nếu là nhập phím số bình thướng
                        else {
                            // chèn vào vị trí đang đặt con trỏ
                            output = val.substring(0, selectionStart) + String.fromCharCode(event.keyCode) + val.substring(selectionEnd);
                            // Tách ra phần nguyên và thập phân để chèn dấu chấm vào giữa
                            destVal = output.substring(0, ml - (dc + 1)) + ',' + output.substring(ml - (dc + 1));
                        }
                        // chuyển vị trí con trỏ về sau 1 đơn vị
                        destSelectionStart = selectionStart + 1;
                        destSelectionEnd = selectionStart + 1;
                    }
                }
                // ĐIều chỉnh lại value theo số ấm hoặc không âm
                if (typeof destVal !== undefined) {
                    // Nếu số am thì thêm dấu trừ vào trước
                    if (destVal && negative) {
                        destVal = '-' + destVal;
                    }
                    if (destVal) {
                        $input.val(destVal);
                    }
                }
                // set lại các vị trí con trỏ
                if (negative && destSelectionStart) {
                    // tăng vị trí bắt đầu của con trỏ lên 1 nếu là số âm, vì số âm trước đó đã bị trừ
                    destSelectionStart++;
                }
                if (destSelectionStart) {
                    // đặt lại vị trí bắt đầu của con trỏ
                    $input.get(0).selectionStart = destSelectionStart;
                }
                if (negative && destSelectionEnd) {
                    // tăng vị trí kết thúc của con trỏ lên 1 nếu là số âm, vì số âm trước đó đã bị trừ
                    destSelectionEnd++;
                }
                if (destSelectionEnd) {
                    // đặt lại vị trí kết thúc của con trỏ
                    $input.get(0).selectionEnd = destSelectionEnd;
                }
                // khi ấn phấm dâu sâm
            }
            else if (event.keyCode === 173 || event.keyCode === 109 || event.keyCode === 189) {
                event.preventDefault();
                // Nếu cho phép nhập số âm
                if (negativeEnabled) {
                    var val = $input.val();
                    var negative = val.indexOf('-') > -1;
                    // Nếu trước đó đã là số âm thì đổi thành số dương
                    if (negative) {
                        $input.val(val.substring(1));
                    }
                    // Nếu không thì cho thành số âm
                    else {
                        $input.val('-' + val);
                    }
                }
            }
        }
        catch (e) {
            console.log('MakeValueWithDecimalFormat: ' + e.message);
            $input.val('');
        }
    };

    /**
     * Kiểm tra xem số có đúng định dạng yêu cầu của số thực hoặc số nguyên quy định ở item input hay không.
     * Nếu đúng thì thêm dấu phẩy phân tách 3 chữ số vào.
     * Đối với việc nhập số thực có thể tùy chọn các tham số sau:
     * - negative (true hoặc false): cho phép nhập số âm hay không
     * - decimal: số chữ số thập phân có thể nhập
     * - maxlength: chiều dài tối đa của ký tự, có kể dấu chấm thập phân, không kể đến các dấu phẩy phân tách group chữ số
     *
     * Author :
 - 2018/07/07 - create
     * @param {object} $input Item được blur
     */
    var InsertCommaToGroupNumber = function ($input) {
        try {
            /** Có cho phép nhập số âm hay không */
            var negativeEnabled = $input.attr('negative');
            /** Giá trị hiện tại */
            var val = $input.val();
            // Xử lý định dạng lại số đã nhập
            if (typeof val !== undefined && val !== '') {
                // Nếu số đang nhập là số âm thì loại bỏ ký tự âm trước khi xử lý
                var negative = val.indexOf('-') > -1;
                var negative_1 = val.indexOf('－') > -1;
                if (negative || negative_1) {
                    val = val.substring(1);
                }
                // Lấy số lượng chữ số thập phân
                var dc = 1 * $input.attr('decimal');
                // Nếu giá trị hiện tại à 1 số thì xử lý tiếp
                var result = parseFloat(val.replace(/\./g, "").replace(/,/g, '.'));
                if (result || result === 0) {
                    // Đổi từ float sang string vs số chữ số thập phân theo yêu cầu
                    result = result.toFixed(dc);
                    // Nếu tồn tại số chữ số thập phân
                    if (result.indexOf(',') > -1) {
                        // Chèn dấu phân tách chữ số ở phần guyên
                        var integer = result.substring(0, result.indexOf(',')).replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                        // Lấy lại phần thập phân
                        var decimal = result.substring(result.indexOf(','));
                        // Kiểm tra gí trị maxlength
                        var ml = typeof $input.attr('maxlength') !== 'undefined' ? parseInt($input.attr('maxlength')) : 0;
                        // Nếu có quy định maxlength và phần nguyên hiện tại đủ để có ít nhất 1 số thập phân
                        if (ml > 0 && integer.length > (ml - 2)) {
                            // Tiến hành bỏ bớt các ký tự sau phần nguyên cho đủ maxlength và số luwongj chữ số thập phân theo yêu cầu
                            var num = ml - dc - 1;
                            var tmp = $input.val().replace(',', "");
                            integer = parseFloat(tmp.substring(0, num));
                            decimal = parseFloat('0.' + tmp.substring(num, num + dc));
                        }
                        val = integer + decimal;
                    }
                    // Nếu không tồn tại chữ số thập phân thì chèm dấu phẩy phân cách mỗi 3 chữ số vào gái trị hiện tại
                    else {
                        val = result.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                    }
                }
                // Nếu không thì xóa gái trị hiện tại đi
                else {
                    val = '';
                }
                // Nếu giá trị sau khi xử lý là 1 số
                if (!isNaN((val + '').replace(/\./g, '').replace(/,/g, '.'))) {
                    // Gán lại cho input giá trị sau khi đã xử lý
                    $input.val((val !== '' && val !== '0' && val !== 'NaN' && negativeEnabled && negative) ? ('-' + val) : val);
                }
                // Nếu không phải thì xóa rỗng input
                else {
                    $input.val('');
                }
            }
        } catch (e) {
            console.log('InsertCommaToGroupNumber: ' + e.message);
        }
    };

    /**
     * Đổi từ 1 chuỗi sang số
     *
     * Author :
 - 2018/07/07 - create
     * @param {string} string Chuỗi cần đổi sang số
     * @return {number} Số được đổi từ string, nếu lỗi hoặc giá trị của string không phải số thì trả về 0
     */
    var ToNumber = function (string) {
        try {
            // Nếu không thể đổi sang số thì trả về 0
            string = string + '';
            var num = 0.0;
            if (!StringModule.IsNullOrEmpty(string)) {
                // Thử đổi sang kiểu float
                var convert = parseFloat(string.replace(/\./g, '').replace(/,/g, '.'));
                if (isNaN(convert)) {
                    // Nếu không được thử đổi sang int
                    convert = parseInt(string.replace(/\./g, ''));
                }
                if (!isNaN(convert)) {
                    // Nếu đổi được thì lấy giá trị đã đổi
                    num = convert;
                }
            }
            return num;
        } catch (e) {
            console.log('ToNumber: ' + e.message);
            return 0;
        }
    };

    /**
     * Kiểm tra số nhập và có phải là 1 số nguyên hay không
     *
     * Author :
 - 2018/07/07 - create
     * @param {string} string chuỗi cần kiểm tra
     * @return {boolean} true nếu đúng là số, false nếu không phải hoặc lỗi
     */
    var ValidateNumber = function (string) {
        try {
            var regexp = /^-*[0-9]+$/;
            if (regexp.test(string) || string === '') {
                return true;
            }
            else {
                return false;
            }
        } catch (e) {
            console.log('ValidateNumber: ' + e.message);
            return false;
        }
    };

    return {
        InitEvents: InitEvents,
        OnlyTypeNumber: OnlyTypeNumber,
        OnlyTypeDecimal: OnlyTypeDecimal,
        MakeValueWithDecimalFormat: MakeValueWithDecimalFormat,
        InsertCommaToGroupNumber: InsertCommaToGroupNumber,
        ToNumber: ToNumber,
        ValidateNumber: ValidateNumber
    };
})();

/*********************************/
/**          Module Date         */
/*********************************/

/**
 * Module chứa các xử lý liên quan đến ngày tháng
 *
 * Author       :
 - 2018/07/07 - create
 *
 * Output       :   DateModule.InitEvents() - Khởi tạo các sự kiện liên quan đến ngày tháng
 * Output       :   DateModule.OnlyTypeDate(event) - Chỉ cho nhập các ký tự phục vụ cho việc nhập ngày tháng
 * Output       :   DateModule.AddSplitToDateString(string) - Thêm dấu phân cách vào chuỗi ngày tháng
 * Output       :   DateModule.RemoveSplitToDateString() - Xóa dấu phân cách khỏi chuỗi ngày tháng
 * Output       :   DateModule.ConvertDateToyyyyMMdd([date, split]) - Đổi từ kiểu ngày tháng sang string với format mặc định yyyy/MM/dd
 * Output       :   DateModule.ConvertDateToddMMyyyy([date, split]) - Đổi từ kiểu ngày tháng sang string với format mặc định dd/MM/yyyy
 * Output       :   DateModule.InitDatePicker([selector]) - Tạo datetime picker cho 1 thẻ input
 * Output       :   DateModule.ToUTCString([dateStr, timeStr, formatDate]) - Đổi từ chuỗi ngày tháng và thời gian sang định dạng UTC yyyy-dd-MMTHH:mm:ss
 */
var DateModule = (function () {

    /**
     * Khởi tạo các sự kiện liên quan đến ngày tháng
     *
     * Author :
 - 2018/07/07 - create
     */
    var InitEvents = function () {
        // Sự kiện khi blur ra khỏi 1 ô nhạp kiểu ngày tháng
        $(document).on('blur', 'input.date ', function () {
            $(this).val(AddSplitToDateString($(this).val()));
        });
        // Sự kiện khi focus vào 1 ô nhập ngày tháng
        $(document).on('focus', 'input.date', function () {
            $(this).val(RemoveSplitToDateString($(this).val()));
        });
        // Sự kiện ấn phín trên một ô nhập ngày tháng
        $(document).on('keydown', 'input.date', function (event) {
            OnlyTypeDate(event);
        });
        /**
         * Thêm phương thức mở rộng đổi từ kiểu ngày tháng sang string định dạng ddMMyyyy
         * với dấu phân cách tùy chọn, mặc định là /
         *
         * Author :
 - 2018/07/07 - create
         * @param {string} [split=/] Ký tự phân cách ngày tháng năm, mặc định là /
         * @return {string} Chuỗi ngày tháng theo định dạng yêu cầu, nếu bị lỗi trả về chuỗi theo dịnh dạng UTC
         */
        Date.prototype.ddMMyyyy = function (split) {
            return ConvertDateToddMMyyyy(this, split);
        };
        /**
         * Thêm phương thức mở rộng đổi từ kiểu ngày tháng sang string định dạng yyyyMMdd
         * với dấu phân cách tùy chọn, mặc định là /
         *
         * Author :
 - 2018/07/07 - create
         * @param {string} [split=/] Ký tự phân cách ngày tháng năm, mặc định là /
         * @return {string} Chuỗi ngày tháng theo định dạng yêu cầu, nếu bị lỗi trả về chuỗi theo dịnh dạng UTC
         */
        Date.prototype.yyyyMMdd = function (split) {
            return ConvertDateToyyyyMMdd(this, split);
        };
        /**
         * Thêm phương thức mở rộng đổi từ kiểu ngày tháng sang string định dạng ddMMMMyyyy
         *
         * Author :
 - 2018/07/07 - create
         * @return {string} Chuỗi ngày tháng theo định dạng yêu cầu, nếu bị lỗi trả về chuỗi theo dịnh dạng UTC
         */
        Date.prototype.ddMMMMyyyy = function (split) {
            return ConvertDateToddMMMMyyyy(this, split);
        };
    };

    /**
     * Thêm dấu / phân cách ngày tháng năm với nhau
     *
     * Author :
 - 2018/07/07 - create
     * @param {string} string Chuỗi ngày tháng cần thêm dấu phân cách
     * @return {string} Chuỗi ngày tháng sau khi đã thêm dấu phân cách
     */
    var AddSplitToDateString = function (string) {
        var val = '';
        try {
            var reg1 = /^[0-9]{8}$/;
            var reg2 = /^[0-9]{2}[\/.][0-9]{2}[\/.][0-9]{4}$/;
            if (string.match(reg1)) {
                // Nếu chưa có dấu phân cách ngày tháng thì thêm vào
                val = string.substring(0, 2) + '/'
                    + string.substring(2, 4) + '/'
                    + string.substring(4);
            }
            else if (string.match(reg2)) {
                // Nếu đúng định dạng ngày tháng rồi thì giữ nguyên
                val = string;
            }
            else {
                // Nếu không đúng định dạng thì xóa về rỗng
                val = '';
            }
            // Kiểm tra nếu không phải là 1 ngày trong năm thì xóa về rỗng
            if (!ValidateModule.ValidateDate(val)) {
                val = '';
            }
        }
        catch (e) {
            console.log('AddSplitToDate: ' + e.message);
        }
        return val;
    };

    /**
     * Xóa dấu / phân cách ngày tháng năm trong chuỗi ngày tháng năm
     *
     * Author :
 - 2018/07/07 - create
     * @param {string} string Chuỗi ngày tháng có dấu phân cách
     * @return {string} Chuỗi ngày tháng sau khi đã bỏ dấu phân cách
     */
    var RemoveSplitToDateString = function (string) {
        var val = '';
        try {
            var reg = /^[0-9]{2}[\/.][0-9]{2}[\/.][0-9]{4}$/;
            // Nếu đúng là dữ liệu ngày thnags thì xóa các dấu phân cách ngày tháng đi
            if (string.match(reg)) {
                val = string.replace(/\D/g, '');
            }
        }
        catch (e) {
            console.log('AddSplitToDate: ' + e.message);
            val = '';
        }
        return val;
    };

    /**
     * Chỉ cho phép nhập ký liên quan đến ngày tháng khi nhấn phím
     *
     * Author :
 - 2018/07/07 - create
     * @param {object} event Sự kiến ấn phím
     * @return {boolean} true nếu phím được phép nhập, false nếu phím không được nhập
     */
    var OnlyTypeDate = function (event) {
        try {
            if (
                !(
                    (event.keyCode > 47 && event.keyCode < 58) // 0 ~ 9
                    || (event.keyCode > 95 && event.keyCode < 106) // 0 ~ 9 numpad
                    || event.keyCode === 116 // F5
                    || event.keyCode === 46 // del
                    || event.keyCode === 35 // end
                    || event.keyCode === 36 // home
                    || event.keyCode === 37 // ←
                    || event.keyCode === 39 // →
                    || event.keyCode === 8 // backspace
                    || event.keyCode === 9 // tab
                    || event.keyCode === 191 // forward slash
                    || event.keyCode === 92 // forward slash
                    || event.keyCode === 111 // divide
                    || (event.shiftKey && event.keyCode === 35) // shift + end
                    || (event.shiftKey && event.keyCode === 36) // shift + home
                    || event.ctrlKey // allow all ctrl combination
                )
                || (event.shiftKey && (event.keyCode > 47 && event.keyCode < 58)) // exlcude Shift + [0~9] (ký tự thứ 2 trên phím số)
            ) {
                event.preventDefault();
                return false;
            }
            return true;
        }
        catch (e) {
            console.log('OnlyTypeDate: ' + e.message);
            return false;
        }
    };

    /**
     * Đổi từ ngày tháng sang string định dạng yyyyMMdd với dấu phân cách tùy chọn, mặc định là /
     *
     * Author :
 - 2018/07/07 - create
     * @param {Date} [date=new Date()] Dữ liệu ngày tháng
     * @param {string} [split=/] Ký tự phân cách ngày tháng năm, mặc định là /
     * @return {string} Chuỗi ngày tháng theo định dạng yêu cầu, nếu bị lỗi trả về chuỗi theo dịnh dạng UTC
     */
    var ConvertDateToyyyyMMdd = function (date, split) {
        try {
            if (StringModule.IsNullOrEmpty(date)) {
                date = new Date();
            }
            if (StringModule.IsNullOrEmpty(split)) {
                split = '/';
            }
            var MM = date.getMonth() + 1; // tháng được đánh số từ 0
            var dd = date.getDate();
            return [date.getFullYear(), (MM > 9 ? '' : '0') + MM, (dd > 9 ? '' : '0') + dd].join(split);
        } catch (e) {
            console.log('ConvertDateToyyyyMMdd: ' + e.message);
            return date.toUTCString();
        }
    };

    /**
     * Đổi từ ngày tháng sang string định dạng ddMMyyyy với dấu phân cách tùy chọn, mặc định là /
     *
     * Author :
 - 2018/07/07 - create
     * @param {Date} [date=new Date()] Dữ liệu ngày tháng
     * @param {string} [split=/] Ký tự phân cách ngày tháng năm, mặc định là /
     * @return {string} Chuỗi ngày tháng theo định dạng yêu cầu, nếu bị lỗi trả về chuỗi theo dịnh dạng UTC
     */
    var ConvertDateToddMMyyyy = function (date, split) {
        try {
            if (StringModule.IsNullOrEmpty(date)) {
                date = new Date();
            }
            if (StringModule.IsNullOrEmpty(split)) {
                split = '/';
            }
            var MM = date.getMonth() + 1; // tháng được đánh số từ 0
            var dd = date.getDate();
            return [(dd > 9 ? '' : '0') + dd, (MM > 9 ? '' : '0') + MM, date.getFullYear()].join(split);
        } catch (e) {
            console.log('ConvertDateToddMMyyyy: ' + e.message);
            return date.toUTCString();
        }
    };

    /**
     * Đổi từ ngày tháng sang string định dạng ddMMMMyyyy
     *
     * Author :
 - 2018/07/07 - create
     * @param {Date} [date=new Date()] Dữ liệu ngày tháng
     * @return {string} Chuỗi ngày tháng theo định dạng yêu cầu, nếu bị lỗi trả về chuỗi theo dịnh dạng UTC
     */
    var ConvertDateToddMMMMyyyy = function (date) {
        try {
            if (StringModule.IsNullOrEmpty(date)) {
                date = new Date();
            }
            var MM = date.getMonth()
            var dd = date.getDate();
            var MMs = [
                'Tháng một',
                'Tháng hai',
                'Tháng ba',
                'Tháng bốn',
                'Tháng năm',
                'Tháng sáu',
                'Tháng bảy',
                'Tháng tám',
                'Tháng chín',
                'Tháng mười',
                'Tháng mười một',
                'Tháng mười hai',
            ]
            return [(dd > 9 ? '' : '0') + dd, MMs[MM], date.getFullYear()].join(' ');
        } catch (e) {
            console.log('ConvertDateToddMMMMyyyy: ' + e.message);
            return date.toUTCString();
        }
    };

    /**
     * Khởi tạo để tạo picker chọn ngày tháng cho 1 input
     *
     * Author :
 - 2018/07/07 - create
     * @param {string} [selector=body] dùng để select các đối tượng cần khởi tạo
     */
    var InitDatePicker = function (selector) {
        try {
            if (StringModule.IsNullOrEmpty(selector)) {
                selector = 'body';
            }
            $(selector).find(".datetimepicker").datetimepicker(CONSTANTS.DATE_OPTION).on("dp.show", function () {
                return $(this).data('DateTimePicker').defaultDate(new Date());
            });
        }
        catch (e) {
            console.log('InitDatePicker: ' + e.message);
        }
    };

    /**
     * Đổi từ chuỗi ngày tháng và thời gian sang định dạng UTC yyyy-dd-MMTHH:mm:ss
     * Nếu tất cả tham số đều rỗng thì thòi gian sẽ là 0 giờ 0 phút 0 giây của ngày hiện tại
     *
     * Author :
 - 2018/07/07 - create
     * @param {string} [dateStr=new Date()] chuỗi string ngày tháng năm, theo định dạng là formatDate, mặc định là ddMMyyyy
     * @param {string} [timeStr=00:00:00] chuỗi string thời gian, định dạng là HH:mm:ss
     * @param {string} [formatDate=ddMMyyyy] theo định dạng của dateStr, mặc định là ddMMyyyy
     * @return {string} Chuỗi ngày tháng theo định dạng UTC
     */
    var ToUTCString = function (dateStr, timeStr, formatDate) {
        try {
            // Lấy thời gian mặc định nếu không truyền thời gian
            if (StringModule.IsNullOrEmpty(timeStr)) {
                timeStr = '00:00:00';
            }
            // lấy định dạng ngày mặc định nếu không truyền
            if (StringModule.IsNullOrEmpty(formatDate)) {
                formatDate = 'ddMMyyyy';
            }
            // Nếu ngày tháng là định dạng ddMMyyyy có dấu phân cách
            if (dateStr !== '' && dateStr.length === 10 && formatDate === 'ddMMyyyy') {
                dateStr = dateStr.substring(6) + '-' + dateStr.substring(3, 5) + '-' + dateStr.substring(0, 2);
            }
            // Nếu ngày tháng là định dạng yyyyMMdd có dấu phân cách
            else if (dateStr !== '' && dateStr.length === 10 && formatDate === 'yyyyMMdd') {
                dateStr = dateStr.substring(0, 4) + '-' + dateStr.substring(5, 7) + '-' + dateStr.substring(9, 10);
            }
            // Nếu ngày tháng là định dạng ddMMyyyy không có dấu phân cách
            else if (dateStr !== '' && dateStr.length === 8 && formatDate === 'ddMMyyyy') {
                dateStr = dateStr.substring(4) + '-' + dateStr.substring(2, 4) + '-' + dateStr.substring(0, 2);
            }
            // Nếu ngày tháng là định dạng yyyyMMdd không có dấu phân cách
            else if (dateStr !== '' && dateStr.length === 8 && formatDate === 'yyyyMMdd') {
                dateStr = dateStr.substring(0, 4) + '-' + dateStr.substring(4, 6) + '-' + dateStr.substring(6, 8);
            }
            // Nếu không truyền ngày tháng thì lấy ngày tháng hiện tại
            else {
                var date = new Date();
                dateStr = date.yyyyMMdd('-');
            }
            return dateStr + 'T' + timeStr;
        } catch (e) {
            console.log('ToUTCString: ' + e.message);
            return dateStr + 'T' + timeStr;
        }
    };

    return {
        InitEvents: InitEvents,
        OnlyTypeDate: OnlyTypeDate,
        AddSplitToDateString: AddSplitToDateString,
        RemoveSplitToDateString: RemoveSplitToDateString,
        ConvertDateToyyyyMMdd: ConvertDateToyyyyMMdd,
        ConvertDateToddMMyyyy: ConvertDateToddMMyyyy,
        InitDatePicker: InitDatePicker,
        ToUTCString: ToUTCString
    };
})();

/*********************************/
/**          Module Time         */
/*********************************/

/**
 * Module chứa các xử lý liên quan đến thời gian
 *
 * Author       :
 - 2018/07/07 - create
 * Output       :   TimeModule.InitEvents() - Khởi tạo các sự kiện liên quan đến thời gian
 * Output       :   TimeModule.InitTimePicker(selector) - Tạo time picker cho 1 thẻ input
 * Output       :   TimeModule.OnlyTypeTime(event) - Chỉ cho nhập các ký tự liên quan đến thời gian
 * Output       :   TimeModule.ConvertDateToddMMyyyyHHmm([datetime, splitDate, splitTime]) - Đổi từ ngày tháng sang string định dạng mặc định là dd/MM/yyyy HH:mm
 * Output       :   TimeModule.ConvertDateToHHmmddMMyyyy([datetime, splitDate, splitTime]) - Đổi từ ngày tháng sang string định dạng mặc định là HH:mm dd/MM/yyyy
 * Output       :   TimeModule.ConvertDateToHHmmssddMMyyyy([datetime, splitDate, splitTime]) - Đổi từ ngày tháng sang string định dạng mặc định là HH:mm:ss dd/MM/yyyy
 * Output       :   TimeModule.ConvertDateToyyyyMMddHHmm([datetime, splitDate, splitTime]) - Đổi từ ngày tháng sang string định dạng mặc định là yyyy/MM/dd HH:mm
 * Output       :   TimeModule.AddSplitToTime(string) - Thêm dâu sphaan cách vào 1 chuỗi thơi fgian
 * Output       :   TimeModule.PadZeroForTime(string[, maxLength]) - Thêm số 0 vào trước chuỗi time để đủ độ dài
 */
var TimeModule = (function () {

    /**
     * Khởi tạo các sự kiện liên quan đến thời gian
     *
     * Author :
 - 2018/07/07 - create
     */
    var InitEvents = function () {
        // Sự kiện nhấn phím nhập thời gian
        $(document).on('keydown', 'input.time', function (event) {
            OnlyTypeTime(event);
        });
        // Sự kiện khi blur ra khỏi 1 ô nhập thời gian
        $(document).on('blur', 'input.time', function () {
            $(this).val(AddSplitToTime($(this).val()));
        });
        // Sự kiện khi focus vào 1 ô nhập thời gian
        $(document).on('focus', 'input.time', function () {
            // Xóa dấu : phân cách thời gian
            $(this).val($(this).val().replace(/:/g, ''));
        });
        /**
         * Thêm phương thức mở rộng đổi từ kiểu ngày tháng sang string định dạng ddMMyyyyHHmm
         *
         * Author :
 - 2018/07/07 - create
         * @param {string} [splitDate=/] Ký tự phân cách ngày tháng năm, mặc định là /
         * @param {string} [splitTime=:] Ký tự phân cách thời gian, mặc định là :
         * @return {string} Chuỗi ngày tháng theo định dạng yêu cầu, nếu bị lỗi trả về chuỗi theo dịnh dạng UTC
         */
        Date.prototype.ddMMyyyyHHmm = function (splitDate, splitTime) {
            return ConvertDateToddMMyyyyHHmm(this, splitDate, splitTime);
        };
        /**
         * Thêm phương thức mở rộng đổi từ kiểu ngày tháng sang string định dạng HHmmddMMyyyy
         *
         * Author :
 - 2018/07/07 - create
         * @param {string} [splitDate=/] Ký tự phân cách ngày tháng năm, mặc định là /
         * @param {string} [splitTime=:] Ký tự phân cách thời gian, mặc định là :
         * @return {string} Chuỗi ngày tháng theo định dạng yêu cầu, nếu bị lỗi trả về chuỗi theo dịnh dạng UTC
         */
         Date.prototype.HHmmddMMyyyy = function (splitDate, splitTime) {
            return ConvertDateToHHmmddMMyyyy(this, splitDate, splitTime);
        };
        /**
         * Thêm phương thức mở rộng đổi từ kiểu ngày tháng sang string định dạng HHmmssddMMyyyy
         *
         * Author :
 - 2018/07/07 - create
         * @param {string} [splitDate=/] Ký tự phân cách ngày tháng năm, mặc định là /
         * @param {string} [splitTime=:] Ký tự phân cách thời gian, mặc định là :
         * @return {string} Chuỗi ngày tháng theo định dạng yêu cầu, nếu bị lỗi trả về chuỗi theo dịnh dạng UTC
         */
         Date.prototype.HHmmssddMMyyyy = function (splitDate, splitTime) {
            return ConvertDateToHHmmssddMMyyyy(this, splitDate, splitTime);
        };
        /**
         * Thêm phương thức mở rộng đổi từ kiểu ngày tháng sang string định dạng yyyyMMddHHmm
         *
         * Author :
 - 2018/07/07 - create
         * @param {string} [splitDate=/] Ký tự phân cách ngày tháng năm, mặc định là /
         * @param {string} [splitTime=:] Ký tự phân cách thời gian, mặc định là :
         * @return {string} Chuỗi ngày tháng theo định dạng yêu cầu, nếu bị lỗi trả về chuỗi theo dịnh dạng UTC
         */
        Date.prototype.yyyyMMddHHmm = function (splitDate, splitTime) {
            return ConvertDateToyyyyMMddHHmm(this, splitDate, splitTime);
        };
    };

    /**
     * Khởi tạo các time picker cho các input nhập thời gian
     *
     * Author :
 - 2018/07/07 - create
     * @param {object} [selector=body] Dùng để select các đối tượng cần khởi tạo
     */
    var InitTimePicker = function (selector) {
        try {
            if (StringModule.IsNullOrEmpty(selector)) {
                selector = 'body';
            }
            $(selector).find(".timepicker").datetimepicker(CONSTANTS.TIME_OPTION).on("dp.show", function () {
                return $(this).data('DateTimePicker').defaultDate(new Date());
            });
        }
        catch (e) {
            console.log('InitTimePicker: ' + e.message);
        }
    };

    /**
     * Chỉ cho phép nhập ký liên quan đến thời gian khi nhấn phím
     *
     * Author :
 - 2018/07/07 - create
     * @param {object} event Sự kiến ấn phím
     * @return {boolean} true nếu phím được phép nhập, false nếu phím không được phép nhập
     */
    var OnlyTypeTime = function (event) {
        try {
            if (
                !(
                    (event.keyCode > 47 && event.keyCode < 58) // 0 ~ 9
                    || (event.keyCode > 95 && event.keyCode < 106) // numpad 0 ~ 9
                    || event.keyCode === 116 // F5
                    || event.keyCode === 46 // del
                    || event.keyCode === 35 // end
                    || event.keyCode === 36 // home
                    || event.keyCode === 37 // ←
                    || event.keyCode === 39 // →
                    || event.keyCode === 8 // backspace
                    || event.keyCode === 9 // tab
                    || (event.shiftKey && event.keyCode === 186) // :
                    || (event.shiftKey && event.keyCode === 35) // shift + end
                    || (event.shiftKey && event.keyCode === 36) // shift + home
                    || event.ctrlKey // allow all ctrl combination
                )
                || (event.shiftKey && (event.keyCode > 47 && event.keyCode < 58))
            ) {
                event.preventDefault();
                return false;
            }
            return true;
        }
        catch (e) {
            console.log('OnlyTypeTime: ' + e.message);
            return false;
        }
    };

    /**
     * Đổi từ ngày tháng sang string định dạng mặc định là dd/MM/yyyy HH:mm
     *
     * Author :
 - 2018/07/07 - create
     * @param {string} [datetime=new Date()] Dữ liệu ngày tháng
     * @param {string} [splitDate=/] Ký tự phân cách ngày tháng năm, mặc định là /
     * @param {string} [splitTime=:] Ký tự phân cách thời gian, mặc định là :
     * @return {string} Chuỗi ngày tháng theo định dạng yêu cầu, nếu bị lỗi trả về chuỗi theo dịnh dạng UTC
     */
    var ConvertDateToddMMyyyyHHmm = function (datetime, splitDate, splitTime) {
        try {
            // Nếu không ngày tháng thì lấy ngày tháng hiện tại
            if (StringModule.IsNullOrEmpty(datetime)) {
                datetime = new Date();
            }
            // Nếu không truyền ký tự phân cách ngày thì lấy ký tự mặc định
            if (StringModule.IsNullOrEmpty(splitDate)) {
                splitDate = '/';
            }
            // Nếu không truyền ký tự phân cách thời gian thì lấy ký tự mặc định
            if (StringModule.IsNullOrEmpty(splitTime)) {
                splitTime = ':';
            }
            // Lây thông tin ngày tháng
            var MM = datetime.getMonth() + 1;
            var dd = datetime.getDate();
            var dateStr = [(dd > 9 ? '' : '0') + dd, (MM > 9 ? '' : '0') + MM, datetime.getFullYear()].join(splitDate);
            // Lấy thông tin thời gian
            var HH = datetime.getHours();
            var mm = datetime.getMinutes();
            var timeStr = [(HH > 9 ? '' : '0') + HH, (mm > 9 ? '' : '0') + mm].join(splitTime);
            // Nối thành chuỗi theo định dạng
            return dateStr + ' ' + timeStr;
        } catch (e) {
            console.log('ConvertDateToddMMyyyyHHmm: ' + e.message);
            return datetime.toUTCString();
        }
    };

    /**
     * Đổi từ ngày tháng sang string định dạng mặc định là HH:mm dd/MM/yyyy
     *
     * Author :
 - 2018/07/07 - create
     * @param {string} [datetime=new Date()] Dữ liệu ngày tháng
     * @param {string} [splitDate=/] Ký tự phân cách ngày tháng năm, mặc định là /
     * @param {string} [splitTime=:] Ký tự phân cách thời gian, mặc định là :
     * @return {string} Chuỗi ngày tháng theo định dạng yêu cầu, nếu bị lỗi trả về chuỗi theo dịnh dạng UTC
     */
    var ConvertDateToHHmmddMMyyyy = function (datetime, splitDate, splitTime) {
        try {
            // Nếu không ngày tháng thì lấy ngày tháng hiện tại
            if (StringModule.IsNullOrEmpty(datetime)) {
                datetime = new Date();
            }
            // Nếu không truyền ký tự phân cách ngày thì lấy ký tự mặc định
            if (StringModule.IsNullOrEmpty(splitDate)) {
                splitDate = '/';
            }
            // Nếu không truyền ký tự phân cách thời gian thì lấy ký tự mặc định
            if (StringModule.IsNullOrEmpty(splitTime)) {
                splitTime = ':';
            }
            // Lây thông tin ngày tháng
            var MM = datetime.getMonth() + 1;
            var dd = datetime.getDate();
            var dateStr = [(dd > 9 ? '' : '0') + dd, (MM > 9 ? '' : '0') + MM, datetime.getFullYear()].join(splitDate);
            // Lấy thông tin thời gian
            var HH = datetime.getHours();
            var mm = datetime.getMinutes();
            var timeStr = [(HH > 9 ? '' : '0') + HH, (mm > 9 ? '' : '0') + mm].join(splitTime);
            // Nối thành chuỗi theo định dạng
            return timeStr + ' ' + dateStr;
        } catch (e) {
            console.log('ConvertDateToddMMyyyyHHmm: ' + e.message);
            return datetime.toUTCString();
        }
    };

    /**
     * Đổi từ ngày tháng sang string định dạng mặc định là HH:mm:ss dd/MM/yyyy
     *
     * Author :
 - 2018/07/07 - create
     * @param {string} [datetime=new Date()] Dữ liệu ngày tháng
     * @param {string} [splitDate=/] Ký tự phân cách ngày tháng năm, mặc định là /
     * @param {string} [splitTime=:] Ký tự phân cách thời gian, mặc định là :
     * @return {string} Chuỗi ngày tháng theo định dạng yêu cầu, nếu bị lỗi trả về chuỗi theo dịnh dạng UTC
     */
     var ConvertDateToHHmmssddMMyyyy = function (datetime, splitDate, splitTime) {
        try {
            // Nếu không ngày tháng thì lấy ngày tháng hiện tại
            if (StringModule.IsNullOrEmpty(datetime)) {
                datetime = new Date();
            }
            // Nếu không truyền ký tự phân cách ngày thì lấy ký tự mặc định
            if (StringModule.IsNullOrEmpty(splitDate)) {
                splitDate = '/';
            }
            // Nếu không truyền ký tự phân cách thời gian thì lấy ký tự mặc định
            if (StringModule.IsNullOrEmpty(splitTime)) {
                splitTime = ':';
            }
            // Lây thông tin ngày tháng
            var MM = datetime.getMonth() + 1;
            var dd = datetime.getDate();
            var dateStr = [(dd > 9 ? '' : '0') + dd, (MM > 9 ? '' : '0') + MM, datetime.getFullYear()].join(splitDate);
            // Lấy thông tin thời gian
            var HH = datetime.getHours();
            var mm = datetime.getMinutes();
            var ss = datetime.getSeconds();
            var timeStr = [(HH > 9 ? '' : '0') + HH, (mm > 9 ? '' : '0') + mm, (ss > 9 ? '' : '0') + ss].join(splitTime);
            // Nối thành chuỗi theo định dạng
            return timeStr + ' ' + dateStr;
        } catch (e) {
            console.log('ConvertDateToddMMyyyyHHmm: ' + e.message);
            return datetime.toUTCString();
        }
    };

    /**
     * Đổi từ ngày tháng sang string định dạng mặc định là yyyy/MM/dd HH:mm
     *
     * Author :
 - 2018/07/07 - create
     * @param {string} [datetime=new Date()] Dữ liệu ngày tháng
     * @param {string} [splitDate=/] Ký tự phân cách ngày tháng năm, mặc định là /
     * @param {string} [splitTime=:]  Ký tự phân cách thời gian, mặc định là :
     * @return {string} Chuỗi ngày tháng theo định dạng yêu cầu, nếu bị lỗi trả về chuỗi theo dịnh dạng UTC
     */
    var ConvertDateToyyyyMMddHHmm = function (datetime, splitDate, splitTime) {
        try {
            // Nếu không ngày tháng thì lấy ngày tháng hiện tại
            if (StringModule.IsNullOrEmpty(datetime)) {
                datetime = new Date();
            }
            // Nếu không truyền ký tự phân cách ngày thì lấy ký tự mặc định
            if (StringModule.IsNullOrEmpty(splitDate)) {
                splitDate = '/';
            }
            // Nếu không truyền ký tự phân cách thời gian thì lấy ký tự mặc định
            if (StringModule.IsNullOrEmpty(splitTime)) {
                splitTime = ':';
            }
            // Lây thông tin ngày tháng
            var MM = datetime.getMonth() + 1;
            var dd = datetime.getDate();
            var dateStr = [datetime.getFullYear(), (MM > 9 ? '' : '0') + MM, (dd > 9 ? '' : '0') + dd].join(splitDate);
            // Lấy thông tin thời gian
            var HH = datetime.getHours();
            var mm = datetime.getMinutes();
            var timeStr = [(HH > 9 ? '' : '0') + HH, (mm > 9 ? '' : '0') + mm].join(splitTime);
            // Nối thành chuỗi theo định dạng
            return dateStr + ' ' + timeStr;
        } catch (e) {
            console.log('ConvertDateToyyyyMMddHHmm: ' + e.message);
            return datetime.toUTCString();
        }
    };

    /**
     * Thêm dấu hiệu phân cách thời gian vào chuỗi thời gian
     *
     * Author :
 - 2018/07/07 - create
     * @param {string} string Chuỗi cần thêm dấu phân cách
     * @return {string} Chuỗi thời gian sau khi đã thêm dấu phân cách, nếu bị lỗi trả về chuỗi rỗng
     */
    var AddSplitToTime = function (string) {
        var val = '';
        try {
            // Thêm cho đủ 4 chữ số về giờ và phút
            string = PadZeroForTime(string);
            var reg1 = /^(([0-1][0-9])|(2[0-3])):[0-5][0-9]$/;
            var reg2 = /^(([0-1][0-9])|(2[0-3]))[0-5][0-9]$/;
            // Nếu đã có dâu sphaan cách thì giữ nguyên
            if (string.match(reg1)) {
                val = string;
            }
            // Nếu chưa có thì thêm vào
            else if (string.match(reg2)) {
                val = string.substring(0, 2) + ':' + string.substring(2, 4);
            }
            // Nếu ko đúng định dạng thì xóa về rỗng
            else {
                val = '';
            }
            // Nếu không phải là thời gian trong ngày cũng xóa về rỗng
            if (!ValidateModule.ValidateTime(val)) {
                val = '';
            }
        }
        catch (e) {
            console.log('AddSplitToTime: ' + e.message);
        }
        return val;
    };

    /**
     * Thêm các chữ số 0 vào trước 1 chuỗi thời gian để đủ 1 độ dài nào đó
     *
     * Author :
 - 2018/07/07 - create
     * @param {string} string Chuỗi cần thêm số 0
     * @param {number} [maxLength=4] Độ dài tối đã chuỗi cần đạt đến, mặc định là 4
     * @return {string} Chuỗi thời gian sau khi đã add thêm số 0, nếu bị lỗi trả về chuỗi rỗng
     */
    var PadZeroForTime = function (string, maxLength) {
        try {
            if (maxLength === undefined || maxLength === null || maxLength === '') {
                maxLength = 4;
            }
            // Xóa bỏ dâu sphaan cách thời gian
            string = string.replace(/:/g, '');
            /** Độ dài hiện tại của chuỗi */
            var lengthOfString = string.length;
            // Nếu chuỗi đầu vào rỗng hoặc dài hơn độ dài yêu cầu thì trả về toàn số 0 (0 giờ 0 phút 0 giây)
            if (StringModule.IsNullOrEmpty(string) || lengthOfString > maxLength) {
                for (var i = 0; i < maxLength; i++) {
                    string += '0';
                }
                return string;
            }
            // Nếu chuỗi đầu vào đã đủ thì trả lại giá trị của chuỗi đầu vào
            if (lengthOfString === maxLength) {
                return string;
            }
            // Thêm số lượng chữ số 0 cần thiết vào trước
            for (var i = 0; i < (maxLength - lengthOfString); i++) {
                string = '0' + string;
            }
            return string;
        }
        catch (e) {
            console.log('PadZeroForTime: ' + e.message);
            return '';
        }
    };

    return {
        InitEvents: InitEvents,
        InitTimePicker: InitTimePicker,
        OnlyTypeTime: OnlyTypeTime,
        ConvertDateToddMMyyyyHHmm: ConvertDateToddMMyyyyHHmm,
        ConvertDateToyyyyMMddHHmm: ConvertDateToyyyyMMddHHmm,
        AddSplitToTime: AddSplitToTime,
        PadZeroForTime: PadZeroForTime
    };
})();

/*********************************/
/**          Module String       */
/*********************************/

/**
 * Module chứa các xử lý liên quan đến chuỗi dữ liệu
 *
 * Author       :
 - 2018/07/07 - create
 *
 * Output       :   StringModule.InitEvents() - Khởi tạo các sự kiện liên quan đến chuỗi ký tự
 * Output       :   StringModule.OnlyAlphabet(event) - Chỉ cho phép nhập ký alphabet khi nhấn phím
 * Output       :   StringModule.CastString(input) - Ghi đè phương thức toString để đối ứng với các dữ liệu null và undefined
 * Output       :   StringModule.IsNullOrEmpty(stringInput) -  Kiểm tra 1 chuỗi đầu vào có bị undefined hay null hay rỗng không
 */
var StringModule = (function () {
    /**
     * Khởi tạo các sự kiện liên quan đến nhập string
     *
     * Author :
 - 2018/07/07 - create
     */
    var InitEvents = function () {
        // Sự kiện nhập vào ô input chỉ cho nhập alphabet
        $(document).on('keydown', 'input.alphabet', function (event) {
            OnlyAlphabet(event);
        });
    };

    /**
     * Chỉ cho phép nhập ký alphabet khi nhấn phím
     *
     * Author :
 - 2018/07/07 - create
     * @param {object} event Sự kiến ấn phím
     * @return {boolean} true nếu phím được nhập, false nếu phím không được nhập
     */
    var OnlyAlphabet = function (event) {
        try {
            if (
                !(
                    (event.keyCode > 47 && event.keyCode < 58) // 0 ~ 9
                    || (event.keyCode > 95 && event.keyCode < 106) // numpad 0 ~ 9
                    || (event.keyCode > 64 && event.keyCode < 91) //A-Z
                    || (event.keyCode > 96 && event.keyCode < 123) //a-z
                    || event.keyCode === 116 // F5
                    || event.keyCode === 46 // del
                    || event.keyCode === 35 // end
                    || event.keyCode === 36 // home
                    || event.keyCode === 37 // ←
                    || event.keyCode === 39 // →
                    || event.keyCode === 8 // backspace
                    || event.keyCode === 9 // tab
                    || event.keyCode === 109 // numpad -
                    || event.keyCode === 189 // -
                    || event.keyCode === 190 // .
                    || event.keyCode === 110 // numpad .
                    || (event.shiftKey && event.keyCode === 189) // _
                    || (event.shiftKey && event.keyCode === 35) // shift + end
                    || (event.shiftKey && event.keyCode === 36) // shift + home
                    || event.ctrlKey // allow all ctrl combination
                )
                || (event.shiftKey && (event.keyCode > 47 && event.keyCode < 58))
            ) {// exlcude
                event.preventDefault();
                return false;
            }
            return true;
        }
        catch (e) {
            console.log('OnlyAlphabet: ' + e.message);
            return false;
        }
    };

    /**
     * Ghi đè phương thức toString để đối ứng với các dữ liệu null và undefined
     *
     * Author :
 - 2018/07/07 - create
     * @param {object} input Giá trị đầu vào
     * @return {string} Giá trị sau khi đã đổi qua string
     */
    var CastString = function (input) {
        try {
            if (IsNullOrEmpty(input)) {
                return '';
            } else {
                return input.toString();
            }
        } catch (e) {
            console.log('CastString: ' + e.message);
            return '';
        }
    };

    /**
     * Kiểm tra 1 chuỗi đầu vào có bị undefined hay null hay rỗng không
     *
     * Author :
 - 2018/07/07 - create
     * @param {object} stringInput Giá trị đầu vào
     * @return {boolean} true nếu chuỗi null hoặc undefined hoặc rỗng, nếu không thì trả về false
     */
    var IsNullOrEmpty = function (stringInput) {
        try {
            if (stringInput === undefined || stringInput === null || stringInput === '') {
                return true;
            }
            else {
                return false;
            }
        } catch (e) {
            console.log('IsNullOrEmpty: ' + e.message);
            return true;
        }
    };

    var PadZero = function (number, length) {
        var str = "" + number;
        while (str.length < length) {
            str = '0' + str;
        }
        return str;
    };

    return {
        InitEvents: InitEvents,
        OnlyAlphabet: OnlyAlphabet,
        CastString: CastString,
        IsNullOrEmpty: IsNullOrEmpty,
        PadZero: PadZero
    };
})();

/*********************************/
/**        Module Validate       */
/*********************************/

/**
 * Module chứa các xử lý liên quan đến kiểm tra dữ liệu đầu vào
 *
 * Author       :
 - 2018/07/07 - create
 *
 * Output       :   ValidateModule.InitEvents() - Khởi tạo các sự kiện liên quan đến kiểm tra dữ liệu
 * Output       :   ValidateModule.IsEmail(email) - Kiểm tra có phải định dạng email hay không
 * Output       :   ValidateModule.IsURL(url) - Kiểm tra có phải định dạng url (link) hay không
 * Output       :   ValidateModule.IsIPAddress(string) -  Kiểm tra có phải định dạng 1 địa chỉ IP hay không
 * Output       :   ValidateModule.IsDate(string) - Kiểm tra có phải là 1 ngày trong năm theo định dạng dd/MM/yyyy hay không
 * Output       :   ValidateModule.ValidateTime(string) - Kiểm tra có phải là 1 chuỗi thời gian hay không
 * Output       :   ValidateModule.ValidateTimeFromTo($dateFrom, $timeFrom, $dateTo, $timeTo) - Kiểm tra thời gian bắt đầu và kết thúc
 * Output       :   ValidateModule.ValidateDateFromTo($dateFrom, $dateTo) -  Kiểm tra ngày bắt đầu và kết thúc
 * Output       :   ValidateModule.Validate(obj) - Kiểm tra dữ liệu nhập vào
 * Output       :   ValidateModule.FocusFirstError() - Focus item lỗi đầu tiên
 * Output       :   ValidateModule.ClearAllError(obj) - Xóa toàn bộ lỗi
 * Output       :   ValidateModule.FillError(errors, firtsSelector) -  Điền lỗi từ server lên màn hình
 */
var ValidateModule = (function () {

    /**
     * Khởi tạo các sự kiện liên quan đến kiểm tra dữ liệu
     *
     * Author :
 - 2018/07/07 - create
     */
    var InitEvents = function () {
        // Sự kiện blur ra item lỗi là item nhập text
        $(document).on('change', 'input, textarea', function () {
            // Xóa lỗi bắt buộc nhập
            if ($(this).val() !== '' && $(this).hasClass('required') && $(this).attr(Notification.TOOLTIP_ATTR) === _msg[MSG_NO.REQUIRED].content) {
                $(this).RemoveError();// file notification.js
            }
        });
        // Sự kiện blur ra item lỗi là item combobox
        $(document).on('change', 'select', function () {
            let $item = $(this);
            if ($(this).hasClass('for-select2')) {
                $item = $(this).parent().find('.select2-selection');
            }
            // Xóa lỗi bắt buộc nhập
            if (($(this).val() + '' != '' || NumberModule.ToNumber($(this).val()) > 0) && $(this).hasClass('required') && $item.attr(Notification.TOOLTIP_ATTR) === _msg[MSG_NO.REQUIRED].content) {
                $item.RemoveError();// file notification.js
            }
        });
    };

    /**
     * Kiểm tra có phải định dạng email hay không
     *
     * Author :
 - 2018/07/07 - create
     * @param {string} email Dữ liệu cần kiểm ttra
     * @return {boolean} true nếu đúng định dạng email, false nếu ngược lại hoặc lỗi
     */
    var IsEmail = function (email) {
        try {
            if (email === '') {
                return false;
            }
            var pattern = /^[\w-.+]+@[a-zA-Z0-9_-]+?\.[a-zA-Z0-9._-]*$/;
            return pattern.test(email);
        }
        catch (e) {
            console.log('IsEmail: ' + e.message);
            return false;
        }
    };

    /**
     * Kiểm tra có phải định dạng url (link) hay không
     *
     * Author :
 - 2018/07/07 - create
     * @param {string} url Dữ liệu cần kiểm ttra
     * @return {boolean} true nếu đúng định dạng url, false nếu ngược lại hoặc lỗi
     */
    var IsURL = function (url) {
        try {
            var pattern = /[-a-zA-Z0-9@:%_\+.~#?&//=]{2,256}\.[a-z]{2,4}\b(\/[-a-zA-Z0-9@:%_\+.~#?&//=]*)?/gi;
            return pattern.test(url);
        }
        catch (e) {
            console.log('IsURL: ' + e.message);
            return false;
        }
    };

    /**
     * Kiểm tra có phải định dạng 1 địa chỉ IP hay không
     *
     * Author :
 - 2018/07/07 - create
     * @param {string} string Dữ liệu cần kiểm tra
     * @return {boolean} true nếu đúng định dạng chuỗi IP, false nếu ngược lại hoặc lỗi
     */
    var IsIPAddress = function (string) {
        try {
            var reg = /^(([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])\.){3}([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])$/;
            if (string.match(reg) || string === '') {
                return true;
            }
            else {
                return false;
            }
        } catch (e) {
            console.log('IsIPAddress: ' + e.message);
            return false;
        }
    };

    /**
     * Kiểm tra có phải là 1 ngày trong năm theo định dạng dd/MM/yyyy hay không
     *
     * Author :
 - 2018/07/07 - create
     * @param {string} string Dữ liệu cần kiểm tra
     * @return {boolean} true nếu đúng là 1 ngày trong năm theo định dạng dd/MM/yyyy, false nếu ngược lại hoặc lỗi
     */
    var IsDate = function (string) {
        try {
            // Chấp nhận chuỗi rống
            if (string === '') {
                return true;
            }
            // Nếu không có dấu phân cách thì thêm vào
            if (string.length === 8) {
                string = string.substring(0, 2) + '/' + string.substring(2, 4) + '/'
                    + string.substring(6);
            }
            var reg = /^(31[\/.](0[13578]|1[02])[\/.]((19|[2-9][0-9])[0-9]{2}))|((29|30)[\/.](01|0[3-9]|1[0-2])[\/.](19|[2-9][0-9])[0-9]{2})|((0[1-9]|1[0-9]|2[0-8])[\/.](0[1-9]|1[0-2])[\/.](19|[2-9][0-9])[0-9]{2})|(29[\/.](02)[\/.](((19|[2-9][0-9])(04|08|[2468][048]|[13579][26]))|2000))$/;
            //Kiểm tra ngày tháng có đúng hay không
            if (string.match(reg)) {
                return true;
            }
            else {
                return false;
            }
        } catch (e) {
            console.log('IsDate: ' + e.message);
            return false;
        }
    };

    /**
     * Kiểm tra có phải là 1 chuỗi thời gian hay không
     *
     * Author :
 - 2018/07/07 - create
     * @param {string} string Dữ liệu cần kiểm tra
     * @return {boolean} true nếu đúng là 1 chuỗi thơi gian, false nếu ngược lại hoặc lỗi
     */
    var ValidateTime = function (string) {
        try {
            var reg = /^(([0-1][0-9])|(2[0-3])):[0-5][0-9]$/;
            var reg2 = /^(([0-1][0-9])|(2[0-3]))[0-5][0-9]$/;
            if (string.match(reg) || string.match(reg2) || string === '') {
                return true;
            }
            else {
                return false;
            }
        } catch (e) {
            console.log('ValidateTime: ' + e.message);
            return false;
        }
    };

    /**
     * Kiểm tra thời gian bắt đầu và kết thúc có đúng hay không
     *
     * Author :
 - 2018/07/07 - create
     * @param {object} $dateFrom Đối tượng HTML có nhập thông tin ngày bắt đầu
     * @param {object} $timeFrom Đối tượng HTML có nhập thông tin thời gian bắt đầu
     * @param {object} $dateTo Đối tượng HTML có nhập thông tin ngày kết thúc
     * @param {object} $timeTo Đối tượng HTML có nhập thông tin thời gian kết thúc
     * @return {boolean} true nếu thời gian bắt đầu nhỏ hơn hoặc bằng thời gian kết thúc, false nếu ngược lại hoặc lỗi
     */
    var ValidateTimeFromTo = function ($dateFrom, $timeFrom, $dateTo, $timeTo) {
        try {
            var validate = true;
            // Chỉ kiểm tra khi đã nhập đủ dữ liệu
            if ($dateFrom.val() !== '' && $dateTo.val() !== '') {
                var timeStart = new Date(DateModule.ToUTCString($dateFrom.val(), $timeFrom.val()));
                var timeEnd = new Date(DateModule.ToUTCString($dateTo.val(), $timeTo.val()));
                if (timeStart > timeEnd) {
                    validate = false;
                    $dateFrom.ItemError(_msg[MSG_NO.TIME_FROM_MUST_LESSER_TIME_TO].content);
                    $timeFrom.ItemError(_msg[MSG_NO.TIME_FROM_MUST_LESSER_TIME_TO].content);
                    $dateTo.ItemError(_msg[MSG_NO.TIME_FROM_MUST_LESSER_TIME_TO].content);
                    $timeTo.ItemError(_msg[MSG_NO.TIME_FROM_MUST_LESSER_TIME_TO].content);
                }
                else {
                    $dateFrom.RemoveError();
                    $timeFrom.RemoveError();
                    $dateTo.RemoveError();
                    $timeTo.RemoveError();
                }
            }
            return validate;
        }
        catch (e) {
            console.log('ValidateTimeFromTo: ' + e.message);
            return false;
        }
    };

    /**
     * Kiểm tra ngày bắt đầu và kết thúc có đúng hay không
     *
     * Author :
 - 2018/07/07 - create
     * @param {object} $dateFrom Đối tượng HTML có nhập thông tin ngày bắt đầu
     * @param {object} $dateTo Đối tượng HTML có nhập thông tin ngày kết thúc
     * @return {boolean} true nếu ngày bắt đầu nhỏ hơn hoặc bằng thời gian kết thúc, false nếu ngược lại hoặc lỗi
     */
    var ValidateDateFromTo = function ($dateFrom, $dateTo) {
        try {
            var validate = true;
            // Chỉ kiểm tra khi đã nhập đủ dữ liệu
            if ($dateFrom.val() !== '' && $dateTo.val() !== '') {
                var timeStart = new Date(DateModule.ToUTCString($dateFrom.val()));
                var timeEnd = new Date(DateModule.ToUTCString($dateTo.val()));
                if (timeStart > timeEnd) {
                    validate = false;
                    $dateFrom.ItemError(_msg[MSG_NO.TIME_FROM_MUST_LESSER_TIME_TO].content);
                    $dateTo.ItemError(_msg[MSG_NO.TIME_FROM_MUST_LESSER_TIME_TO].content);
                }
                else {
                    $dateFrom.RemoveError();
                    $dateTo.RemoveError();
                }
            }
            return validate;
        }
        catch (e) {
            console.log('ValidateDateFromTo: ' + e.message);
            return false;
        }
    };

    /**
     * Kiểm tra dữ liệu nhập vào từ màn hình có đúng yêu cầu hay không theo đối tượng liên kết với các item trên màn hình.
     * Fill lỗi lên các item bị lỗi
     *
     * Author :
 - 2018/07/07 - create
     * @param {...Object.<string, ItemHtml>} obj Đối tượng các item cần kiểm tra và các điều kiện cần kiểm tra
     * @return {boolean} true nếu tất cả các dữ liệu điều đúng, false nếu ngược lại hoặc lỗi
     */
    var _validateByObject = function (obj) {
        try {
            // đếm số lỗi
            var error = 0;
            // Xóa hết lỗi trên object
            ClearAllError(obj);
            // Duyệt qua từng item cần kiểm tra
            $.each(obj, function (key, element) {
                if (StringModule.IsNullOrEmpty(element['attr']['not_check']) || element['attr']['not_check'] !== true) {
                    /** Class dừng để kiểm tra */
                    var className = element['attr']['class'];
                    /** Độ dài tối đa có thể nhập */
                    var maxlength = element['attr']['maxlength'];
                    /** Độ dài tối thiểu cần nhập */
                    var minlength = element['attr']['minlength'];
                    // Lấy câu thông báo về maxlength và min length
                    /** Câu thông báo maxlength */
                    var msg_maxlength = '';
                    /** Câu thông báo minlength */
                    var msg_minlength = '';
                    if (typeof (_msg) !== 'undefined' && _msg[MSG_NO.EXCEED_MAXLENGTH] !== undefined) {
                        msg_maxlength = _msg[MSG_NO.EXCEED_MAXLENGTH].content.replace('{0}', maxlength);
                    }
                    if (typeof (_msg) !== 'undefined' && _msg[MSG_NO.NOT_ENOUGH_MIN_LENGTH] !== undefined) {
                        msg_minlength = _msg[MSG_NO.NOT_ENOUGH_MIN_LENGTH].content.replace('{1}', minlength);
                    }
                    // Nếu đối tượng cần kiểm tra là 1 CKEditor
                    if (element['type'] === 'CKEditor' || element['attr']['isCKEditor']) {
                        try {
                            // Lấy lại đối tượng editor
                            var editor = CKEDITOR.instances[key];
                            // Nếu cần kiểm tra maxlength
                            if (maxlength !== undefined && maxlength !== null && maxlength > 0) {
                                // Lấy dữ liệu ra và kiểm tra độ dài
                                if (editor.getData().length > maxlength) {
                                    // Nếu quá maxlength thì báo lỗi
                                    error += 1;
                                    $('.cke_editor_' + editor.name).ItemError(msg_maxlength);
                                }
                            }
                            // Nếu cần kiểm tra minlength
                            if (minlength !== undefined && minlength !== null && minlength > 0) {
                                // Lấy dữ liệu ra và kiểm tra độ dài
                                if (editor.getData().length < minlength) {
                                    // Nếu chứ đủ minlength thì báo lỗi
                                    error += 1;
                                    $('.cke_editor_' + editor.name).ItemError(msg_minlength);
                                }
                            }
                            // Nếu bắt buộc nhập
                            if (/required/.test(className)) {
                                // mà dữ liệu của ditor không có
                                if (editor.getData().length === 0) {
                                    // thì báo lỗi
                                    error += 1;
                                    $('.cke_editor_' + editor.name).ItemError(_msg[MSG_NO.REQUIRED].content);
                                }
                            }
                        } catch (ex) {
                            console.log('ValidateCkeditor: ' + ex.message);
                        }
                    }
                    else {
                        // Nếu không phải là CKEditor thì select đối tượng trên màn hình ra theo id
                        var selector = '#' + key;
                        // Nếu quy định là lấy theo class thì dùng selector class
                        if (element['attr']['isClass'] === true) {
                            selector = '.' + key;
                        }
                        $('body').find(selector).each(function () {
                            // Nếu item hiện tại bị disable hoặc quy định là không kiểm tra lỗi thì bỏ qua.
                            // Nếu không thì tiến hành kiểm tra
                            if (!$(this).is(':disabled') && $(this).attr('not-check') !== "true") {
                                // Kiêm tra bắt buộc nhập nếu có quy định
                                if (/required/.test(className)) {
                                    // Nếu text bằng rỗng và combobox bằng 0 thì sẽ hiểu là không nhập dữ liệu
                                    if ($(this).val() === ''
                                        || (element['type'] === 'select' && $(this).attr('multiple') != undefined && $(this).val() + '' == '')
                                        || (element['type'] === 'select' && $(this).attr('multiple') == undefined && NumberModule.ToNumber($(this).val()) === 0)
                                    ) {
                                        if ($(this).hasClass('taginput')) {
                                            $('#' + $(this).attr('id') + '_tagsinput').ItemError(_msg[MSG_NO.REQUIRED].content);
                                        }
                                        else if ($(this).hasClass('for-select2')) {
                                            $(this).parent().find('.select2-selection').ItemError(_msg[MSG_NO.REQUIRED].content);
                                        }
                                        else {
                                            $(this).ItemError(_msg[MSG_NO.REQUIRED].content);
                                        }
                                        error++;
                                    }
                                }
                                // Kiểm tra minlength và maxlength nếu có quy định
                                if (maxlength !== undefined || minlength !== undefined) {
                                    var val = $(this).val();
                                    // Bỏ các dấu phân cách đối với các dữ liệu có yếu tố phân cách
                                    if ($(this).hasClass('numeric') || $(this).hasClass('decimal')) {
                                        val = val.replace(/,/g, '');
                                    }
                                    if ($(this).hasClass('date') || $(this).hasClass('month')) {
                                        val = val.replace(/\//g, '');
                                    }
                                    if ($(this).hasClass('time')) {
                                        val = val.replace(/:/g, '');
                                    }
                                    // Kiểm tra xem có quá maxlength không
                                    if (val.length > maxlength) {
                                        if ($(this).hasClass('taginput')) {
                                            $('#' + $(this).attr('id') + '_tagsinput').ItemError(msg_maxlength);
                                        }
                                        else {
                                            $(this).ItemError(msg_maxlength);
                                        }
                                        error++;
                                    }
                                    // Kiêm tra xem đủ minlength không
                                    if (val.length < minlength) {
                                        $(this).ItemError(msg_minlength);
                                        error++;
                                    }
                                }
                                // Nếu có nhập giá trị và có quy đinh check email thì tiến hành kiểm tra định dạng email
                                if ($(this).val() !== '' && (/email/.test(className) || element['type'] === 'email')) {
                                    if (!IsEmail($(this).val())) {
                                        $(this).ItemError(_msg[MSG_NO.EMAIL_FORMAT_RON].content);
                                        error++;
                                    }
                                }
                                // Nếu có nhập giá trị và có quy đinh check định dạng date dd/MM/yyyy
                                // thì tiến hành kiểm tra định dạng date
                                if ($(this).val() !== '' && element['type'] === 'date') {
                                    if (!IsDate($(this).val())) {
                                        $(this).ItemError(_msg[MSG_NO.DATE_FORMAT_RON].content);
                                        error++;
                                    }
                                }
                                // Nếu có nhập giá trị và có quy đinh check url thì tiến hành kiểm tra định dạng url
                                if ($(this).val() !== '' && /url/.test(className)) {
                                    if (!IsURL($(this).val())) {
                                        $(this).ItemError(_msg[MSG_NO.URL_FORMAT_RON].content);
                                        error++;
                                    }
                                }
                                // Nếu có nhập giá trị và có quy đinh check đị chỉ IP
                                // thì tiến hành kiểm tra định dạng địa chỉ IP
                                if ($(this).val() !== '' && /ip_address/.test(className)) {
                                    if (!IsIPAddress($(this).val())) {
                                        $(this).ItemError(_msg[MSG_NO.IP_ADDRESS_FORMAT_RON].content);
                                        error++;
                                    }
                                }
                                // Nếu có nhập giá trị và có quy đinh check lớn hơn 1 giá trị nào đó
                                // thì tiến hành kiểm tra có lớn hơn giá trị đã quy định hay không
                                if (/gt/.test(className) && $(this).attr('gt')) {
                                    if (NumberModule.ToNumber($(this).val()) < NumberModule.ToNumber($(this).attr('gt'))) {
                                        $(this).ItemError(_msg[MSG_NO.VALUE_MUST_GEATER].content.replace('{2}', $(this).attr('gt')));
                                        error++;
                                    }
                                }
                                // Nếu có nhập giá trị và có quy đinh check nhỏ hơn 1 giá trị nào đó
                                // thì tiến hành kiểm tra có nhỏ hơn giá trị đã quy định hay không
                                if (/gz/.test(className) && $(this).attr('gz')) {
                                    if (NumberModule.ToNumber($(this).val()) > NumberModule.ToNumber($(this).attr('gz'))) {
                                        $(this).ItemError(_msg[MSG_NO.VALUE_MUST_LESSER].content.replace('{3}', $(this).attr('gz')));
                                        error++;
                                    }
                                }
                            }
                        });
                    }
                }
            });
            if (error > 0) {
                // Nếu có lỗi thì trả về false và focus vào item lỗi đầu tiên
                FocusFirstError();
                return false;
            }
            else {
                return true;
            }
        } catch (e) {
            console.log('_validateByObject: ' + e.message);
        }
    };

    /**
     * Kiểm tra dữ liệu nhập vào từ màn hình có đúng yêu cầu hay không theo selector.
     * Fill lỗi lên các item bị lỗi
     *
     * Author :
 - 2018/07/07 - create
     * @param {string} selector select đối tượng HTML có chứa các item cần kiểm tra
     * @return {boolean} true nếu tất cả các dữ liệu điều đúng, false nếu ngược lại hoặc lỗi
     */
    var _validateBySelector = function (selector) {
        try {
            // đếm số lỗi
            var error = 0;
            // Loại trừ cacsc item ko check validate
            var noCheck = ':not([disabled="disabled"]):not([not-check="true"])';
            // Xóa hết lỗi của các đối tượng trong phân vùng của html select được
            ClearAllError(selector);
            // Tìm trong vùng của đối tượng HTML select được các đối tượng cần check bắt buộc nhập
            $(selector).find('.required' + noCheck).each(function () {
                // Nếu item cần check là CKEditor
                if ($(this).hasClass('isCKEditor')) {
                    // lấy lại editor
                    var editor = CKEDITOR.instances[$(this).attr("id")];
                    // Kiêm tra có nhập data hay không
                    if (editor.getData().length === 0) {
                        error += 1;
                        $('.cke_editor_' + editor.name).ItemError(_msg[MSG_NO.REQUIRED].content);
                    }
                }
                // Nếu là ô nhập tag
                else if ($(this).hasClass('taginput')) {
                    var id = '#' + $(this).attr('id') + '_tagsinput';
                    var val = $(this).val() + '';
                    if (val === '' || ($(this).is('select') && val === '0')) {
                        // thì báo lỗi trên div nhập tag input
                        $(id).ItemError(_msg[MSG_NO.REQUIRED].content);
                        error++;
                    }
                }
                else if ($(this).hasClass('for-select2')) {
                    var val = $(this).val() + '';
                    if (val === '' ||
                        ($(this).is('select') && $(this).attr('multiple') != undefined && val == '') ||
                        ($(this).is('select') && $(this).attr('multiple') == undefined && val == '0')
                    ) {
                        $(this).parent().find('.select2-selection').ItemError(_msg[MSG_NO.REQUIRED].content);
                        error++;
                    }
                }
                else {
                    // Nếu là item bình thường và có giá trị rỗng (đối với item nhập text) hoặc 0 (với combobox)
                    var val = $(this).val() + '';
                    if (val == '' ||
                        ($(this).is('select') && $(this).attr('multiple') != undefined && val == '') ||
                        ($(this).is('select') && $(this).attr('multiple') == undefined && val == '0')
                    ) {
                        // thì báo lỗi
                        $(this).ItemError(_msg[MSG_NO.REQUIRED].content);
                        error++;
                    }
                }
            });
            // Tìm trong vùng của đối tượng HTML select được các đối tượng cần check min length và maxlength
            $(selector).find('input[type=text],input[type=tel],input[type=password],input[type=email],textarea').each(function () {
                if (!$(this).is(':disabled') && $(this).attr('not-check') !== "true") {
                    /** Lấy maxlength đã quy định */
                    var maxlength = $(this).attr('maxlength');
                    // Nếu có quy định check maxlength thì xử lý tiếp
                    if (maxlength !== undefined && maxlength !== null && (maxlength + '' !== '')) {
                        /** Câu thông báo cho maxlength */
                        var msg_maxlength = '';
                        if (typeof (_msg) !== 'undefined' && _msg[MSG_NO.EXCEED_MAXLENGTH] !== undefined) {
                            msg_maxlength = _msg[MSG_NO.EXCEED_MAXLENGTH].content.replace('{0}', maxlength);
                        }
                        // Nếu item cần check là CKEditor
                        if ($(this).hasClass('isCKEditor')) {
                            // lấy lại editor
                            var editor = CKEDITOR.instances[$(this).attr("id")];
                            // và lấy dữ liệu trong editor để check maxlength
                            if (editor.getData().length > maxlength) {
                                error += 1;
                                $('.cke_editor_' + editor.name).ItemError(msg_maxlength);
                            }
                        }
                        // Nếu là ô nhập tag
                        else if ($(this).hasClass('taginput')) {
                            var id = '#' + $(this).attr('id') + '_tagsinput';
                            // Kiểm tra độ dài ký tự
                            if ($(this).val().length > maxlength) {
                                $(id).ItemError(msg_maxlength);
                                error++;
                            }
                        }
                        // Nếu là item bình thường
                        else {
                            val = $(this).val() + '';
                            // Loại bỏ các dấu phân cách đối với dữ liệu có phần cách
                            if ($(this).hasClass('numeric') || $(this).hasClass('decimal')) {
                                val = val.replace(/,/g, '');
                            }
                            if ($(this).hasClass('date') || $(this).hasClass('month')) {
                                val = val.replace(/\//g, '');
                            }
                            if ($(this).hasClass('time')) {
                                val = val.replace(/:/g, '');
                            }
                            // Kiểm tra độ dài ký tự
                            if (val.length > maxlength) {
                                $(this).ItemError(msg_maxlength);
                                error++;
                            }
                        }
                    }
                    /** Lấy minlength đã quy định */
                    var minlength = $(this).attr('minlength');
                    // Nếu có quy định check minlength thì xử lý tiếp
                    if (minlength !== undefined && minlength !== null && (minlength + '' !== '')) {
                        /** Câu thông báo cho minlength */
                        var msg_minlength = '';
                        if (typeof (_msg) !== 'undefined' && _msg[MSG_NO.NOT_ENOUGH_MIN_LENGTH] !== undefined) {
                            msg_minlength = _msg[MSG_NO.NOT_ENOUGH_MIN_LENGTH].content.replace('{1}', minlength);
                        }
                        // Nếu item cần check là CKEditor
                        if ($(this).hasClass('isCKEditor')) {
                            // lấy lại editor
                            var editor = CKEDITOR.instances[$(this).attr("id")];
                            // và lấy dữ liệu trong editor để check minlength
                            if (editor.getData().length < minlength) {
                                error += 1;
                                $('.cke_editor_' + editor.name).ItemError(msg_minlength);
                            }
                        }
                        // Nếu là item bình thường
                        else {
                            val = $(this).val() + '';
                            // Loại bỏ các dấu phân cách đối với dữ liệu có phần cách
                            if ($(this).hasClass('numeric') || $(this).hasClass('decimal')) {
                                val = val.replace(/,/g, '');
                            }
                            if ($(this).hasClass('date') || $(this).hasClass('month')) {
                                val = val.replace(/\//g, '');
                            }
                            if ($(this).hasClass('time')) {
                                val = val.replace(/:/g, '');
                            }
                            // Kiểm tra độ dài ký tự
                            if (val.length < minlength) {
                                $(this).ItemError(msg_minlength);
                                error++;
                            }
                        }
                    }
                }
            });
            // Tìm trong vùng của đối tượng HTML select được các đối tượng cần check email và tiến hành check
            $(selector).find('input[type=email]' + noCheck + ',.email' + noCheck).each(function () {
                if (!IsEmail($(this).val())) {
                    $(this).ItemError(_msg[MSG_NO.EMAIL_FORMAT_RON].content);
                    error++;
                }
            });
            // Tìm trong vùng của đối tượng HTML select được các đối tượng cần check định dạng ngày tháng dd/MM/yyyy
            // và tiến hành check
            $(selector).find('.date' + noCheck).each(function () {
                if (!IsDate($(this).val())) {
                    $(this).ItemError(_msg[MSG_NO.DATE_FORMAT_RON].content);
                    error++;
                }
            });
            // Tìm trong vùng của đối tượng HTML select được các đối tượng cần check url và tiến hành check
            $(selector).find('.url' + noCheck).each(function () {
                if (!IsURL($(this).val())) {
                    $(this).ItemError(_msg[MSG_NO.URL_FORMAT_RON].content);
                    error++;
                }
            });
            // Tìm trong vùng của đối tượng HTML select được các đối tượng cần check địa chỉ IP và tiến hành check
            $(selector).find('.ip_address' + noCheck).each(function () {
                if (!IsIPAddress($(this).val())) {
                    $(this).ItemError(_msg[MSG_NO.IP_ADDRESS_FORMAT_RON].content);
                    error++;
                }
            });
            // Tìm trong vùng của đối tượng HTML select được các đối tượng cần check lớn hơn 1 giá trị nào đó
            // và tiến hành check
            $(selector).find('.gt' + noCheck).each(function () {
                if (NumberModule.ToNumber($(this).val()) < NumberModule.ToNumber($(this).attr('gt'))) {
                    $(this).ItemError(_msg[MSG_NO.VALUE_MUST_GEATER].content.replace('{2}', $(this).attr('gt')));
                    error++;
                }
            });
            // Tìm trong vùng của đối tượng HTML select được các đối tượng cần check nhỏ hơn 1 giá trị nào đó
            // và tiến hành check
            $(selector).find('.gz' + noCheck).each(function () {
                if (NumberModule.ToNumber($(this).val()) > NumberModule.ToNumber($(this).attr('gz'))) {
                    $(this).ItemError(_msg[MSG_NO.VALUE_MUST_LESSER].content.replace('{3}', $(this).attr('gz')));
                    error++;
                }
            });
            if (error > 0) {
                // Nếu có lỗi thì focus item lỗi đầu tiên
                FocusFirstError();
                return false;
            }
            else {
                return true;
            }
        } catch (e) {
            console.log('_validateBySelector: ' + e.message);
        }
    };

    /**
     * Kiểm tra dữ liệu nhập vào từ màn hình có đúng yêu cầu hay không
     *
     * Author :
 - 2018/07/07 - create
     * @param {...Object.<string, ItemHtml>|string} obj
     * string: selector của vùng cần check
     * object: đối tượng chứa các item cần check
     * @return {boolean} true nếu tất cả các dữ liệu điều đúng, false nếu ngược lại hoặc lỗi
     */
    var Validate = function (obj) {
        try {
            if (typeof obj === 'object') {
                return _validateByObject(obj);
            }
            else {
                return _validateBySelector(obj);
            }
        } catch (e) {
            console.log('Validate: ' + e.message);
            return false;
        }
    };

    /**
     * Focus vào item lỗi đầu tiên
     *
     * Author :
 - 2018/07/07 - create
     */
    var FocusFirstError = function () {
        try {
            $('.' + Notification.STYLE_ERROR + ':first').focus();
        } catch (e) {
            console.log('FocusFirstError: ' + e.message);
        }
    };

    /**
     * Xóa toàn bộ bỗi
     *
     * Author :
 - 2018/07/07 - create
     * @param {...Object.<string, ItemHtml>|string} obj
     * string: selector của vùng cần xóa lỗi
     * object: đối tượng chứa các item cần xóa lỗi
     */
    var ClearAllError = function (obj) {
        try {
            // Nếu dữ liệu vào là 1 đối tượng chứa các item cần xóa lỗi
            if (typeof obj === 'object') {
                // Duyệt qua từng đối tượng
                $.each(obj, function (key, element) {
                    // Lấy lại đối tượng đó trên màn hình
                    var selector = '#' + key;
                    if (element['attr']['isClass'] === true) {
                        selector = '.' + key;
                    }
                    // Xóa lỗi của đối tượng đó
                    let $item = $(selector);
                    if ($item.hasClass('for-select2')) {
                        $item = $item.parent().find('.select2-selection');
                    }
                    $item.css({
                        'border': ''
                    });
                    $item.removeAttr(Notification.TOOLTIP_ATTR);
                    $item.removeClass(Notification.STYLE_ERROR);
                });
            }
            // Nếu dữ liệu vào là selector của vùng chứa các item cần xóa lỗi
            else {
                if (StringModule.IsNullOrEmpty(obj)) {
                    obj = 'body';
                }
                // thì tìm tất cả các item đang lỗi và xóa thoogn báo lỗi đi
                $(obj).find('.' + Notification.STYLE_ERROR).each(function () {
                    $(this).css({
                        'border': ''
                    });
                    $(this).removeAttr(Notification.TOOLTIP_ATTR);
                    $(this).removeClass(Notification.STYLE_ERROR);
                });
            }
            $('#' + Notification.TOOLTIP_ID).remove();
        } catch (e) {
            console.log('ClearAllError' + e.message);
        }
    };

    /**
     * Điền thông tin lỗi vào item lỗi được trả về từ validate của server
     *
     * Author :
 - 2018/07/07 - create
     * @param {...Object<string,string>} errors list lỗi từ server
     * @param {string} firtsSelector selecttor cho thẻ cha của item bị lỗi
     */
    var FillError = function (errors, firtsSelector) {
        try {
            if (StringModule.IsNullOrEmpty(firtsSelector)) {
                firtsSelector = '';
            }
            for (var err in errors) {
                if (errors.hasOwnProperty(err)) {
                    // Lấy lại item lỗi trên mành hình
                    /** Item bị lỗi trên màn hình */
                    var name = err;
                    var idx = name.indexOf('.');
                    if (idx > -1) {
                        name = name.replace('.','[');
                        name = name.replace(/\./g,'][');
                        name += ']';
                    }
                    var $itemError = $(firtsSelector + ' [name="' + name + '"]');
                    var contentError = _msg[errors[err][0]].content;
                    var value0 = $itemError.attr('maxlength'); // giá trị maxlength
                    var value1 = $itemError.attr('minlength'); // giá trị minlength
                    var value2 = $itemError.attr('gt'); // giá trị cần lớn hơn
                    var value3 = $itemError.attr('gz'); // giá trị cần nhỏ hơn
                    // Thay vào câu thông báo để trực quan hơn
                    contentError = contentError.replace('{0}', value0);
                    contentError = contentError.replace('{1}', value1);
                    contentError = contentError.replace('{2}', value2);
                    contentError = contentError.replace('{3}', value3);
                    if ($itemError.hasClass('for-select2')) {
                        $itemError = $itemError.parent().find('.select2-selection');
                    }
                    $itemError.ItemError(contentError);
                }
            }
        } catch (e) {
            console.log('FillError' + e.message);
        }
    };

    return {
        InitEvents: InitEvents,
        IsURL: IsURL,
        IsEmail: IsEmail,
        IsIPAddress: IsIPAddress,
        ValidateTime: ValidateTime,
        ValidateTimeFromTo: ValidateTimeFromTo,
        ValidateDateFromTo: ValidateDateFromTo,
        ValidateDate: IsDate,
        Validate: Validate,
        FocusFirstError: FocusFirstError,
        ClearAllError: ClearAllError,
        FillError: FillError
    };
})();

/*********************************/
/**          Module Common       */
/*********************************/

/**
 * Module chứa các xử lý chung thường hay sử dụng
 *
 * Author       :
 - 2018/07/07 - create
 *
 * Output       :   Common.InitEvents() - Khởi tạo các sự kiện chung của hệ thống
 * Output       :   Common.InitItem(obj) - Cài đặt và gán các thuộc tính cho item trên màn hình tuowng ứng với đối tượng truyền vào
 * Output       :   Common.GetData(obj) - Lấy dữ liệu nhập vào từ màn hình theo danh sách các item truyền vào
 * Output       :   Common.CallLoading() -  Tạo icon loading che hết màn hình khi sử dụng ajax
 * Output       :   Common.CloseLoading() - Xóa màn loading để có thể tương tác tiếp
 * Output       :   Common.GetLastOfUrl(url) - Lấy phần tử cuối cùng của 1 URL
 * Output       :   Common.Serialize(obj) - Tạo query string gắn trên đường dẫn từ 1 đối tượng data
 * Output       :   Common.ChangeUrl(page, url) -  Thay đổi đường link trên trình duyệt để lưu lịch sử mà không cần load lại trang
 * Output       :   Common.BackToList(key, defaultLink) - Trở về trang list với trạng thái như lúc trước từ trang master
 * Output       :   Common.SaveSuccess(res[, callback, callbackError]) - Hàm sử lý chung sau khi lưu một dữ liệu nào đó
 * Output       :   Common.DeleteSuccess(res[, callback, callbackError]) - Hàm sử lý chung sau khi xóa một dữ liệu nào đó
 * Output       :   Common.SetTabindex() -  Đánh tabindex cho các item trên màn hình để có thể sử dụng tab
 * Output       :   Common.ConvertToUnSign(str) -  Đổi chuổi tiếng việt có dấu sang không dấu, bỏ dấu cách và các ký tự đặc biệt
 * Output       :   Common.DisableFunction([disableFull]) - Khóa các chức năng không cho người dùng bật debug và xem source code
 * Output       :   Common.GetLanIp([callback]) - Lấy IP local (private IP) của máy user đang tương tác
 * Output       :   Common.IsMobile() - Kiểm tra thiết bị đang dùng có phải là mobile hay không
 * Output       :   Common.CompareDataInScreen(oldData, newData) -  So sánh 2 dữ liệu có bằng nhau hay không.
 * Output       :   Common.GetSelectedOption($select) -  Lấy thẻ option đang chọn của 1 thẻ select.
 */
var Common = (function () {
    /**
     * Khởi tạo các sự kiện chung của hệ thống
     *
     * Author :
 - 2018/07/07 - create
     */
    var InitEvents = function () {
        // Cài đặt mở icon loading mỗi lần gọi ajax
        $(document).ajaxStart(function () {
            CallLoading();
        });
        // Cài đặt tắt icon loading mỗi lần gọi ajax xong
        $(document).ajaxComplete(function () {
            CloseLoading();
        });
        // Sự kiện khi focus vào 1 itam input nào đó
        $(document).on('focus', 'input', function () {
            // Select toàn bộ text có trong đó
            $(this).select();
        });
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        // Cài đặt tabindex tự động cho toàn trang
        SetTabindex();
    };

    /**
     * Cài đặt và gán các thuộc tính cho item trên màn hình tuowng ứng với đối tượng truyền vào
     *
     * Author :
 - 2018/07/07 - create
     * @param {...Object.<string, ItemHtml>} obj Đối tượng các item liên kết với các item trên màn hình
     */
    var InitItem = function (obj) {
        try {
            var i = 0;
            // Lấy lại item đầu tiên để focus
            var firstElement = '';
            // Duyệt qua từng item
            $.each(obj, function (key, element) {
                // Chọn item tương ứng ở trên màn hình
                var selector = '#' + key;
                if (element['attr']['isClass'] === true) {
                    selector = '.' + key;
                }
                if (i === 0) {
                    firstElement = selector;
                }
                i++;
                // Nếu là CkEditor
                if (element['type'] === 'CKEditor' || element['attr']['isCKEditor']) {
                    try {
                        $(selector).addClass('isCKEditor');
                        // Khởi tạo bộ editor
                        var editor = CKEDITOR.replace(key, {
                            height: element['attr']['height'] ? element['attr']['height'] : 100,
                            toolbar: element['attr']['toolbar'] ? element['attr']['toolbar'] : "Full",
                        });
                        // Nếu có yêu cầu set tabindex thì set tabindex cho CKEditor
                        if (element['attr']['tabindex'] !== undefined) {
                            setTimeout(function () {
                                $('.cke_editor_' + editor.name + ' iframe').attr('tabindex', element['attr']['tabindex']);
                            }, 1000);
                        }
                        // Đặt sự kiện nếu có thay đổi dữ liệu thì xóa lỗi hiển thị nếu có
                        // và set giá trị thay đổi vào item sử dụng editor này
                        editor.on('change', function () {
                            if ($('.cke_editor_' + editor.name).hasClass(Notification.STYLE_ERROR)) {
                                $('.cke_editor_' + editor.name).RemoveError();
                            }
                            $(selector).val(CKEDITOR.instances[key].getData());
                        });
                    } catch (ex) {
                        console.log('InitCkeditor: ' + ex.message);
                    }
                }
                else {
                    // thêm thuộc tính maxlength
                    if (element['attr']['maxlength'] !== undefined) {
                        $(selector).attr('maxlength', element['attr']['maxlength']);
                    }
                    // thêm class
                    if (element['attr']['class'] !== undefined) {
                        $(selector).addClass(element['attr']['class']);
                    }
                    // thêm thuộc tính decimal
                    if (element['attr']['decimal'] !== undefined) {
                        $(selector).attr('decimal', element['attr']['decimal']);
                    }
                    // thêm thuộc tính readonly
                    if (element['attr']['readonly'] !== undefined) {
                        $(selector).attr('readonly', element['attr']['readonly']);
                    }
                    if (element['attr']['disabled'] !== undefined) {
                        $(selector).attr('disabled', element['attr']['disabled']);
                    }
                    // thêm thuộc tính tabindex
                    if (element['attr']['tabindex'] !== undefined) {
                        $(selector).attr('tabindex', element['attr']['tabindex']);
                    }
                    // thêm thuộc tính nocheck để quy định không check
                    if (element['attr']['not_check'] !== undefined) {
                        $(selector).attr('not-check', element['attr']['not_check']);
                    }
                    // thêm thuộc tính minlength
                    if (element['attr']['minlength'] !== undefined) {
                        $(selector).attr('minlength', element['attr']['minlength']);
                    }
                    // thêm thuộc tính gt để gán giá trị min
                    if (element['attr']['gt'] !== undefined) {
                        $(selector).attr('gt', element['attr']['gt']);
                    }
                    // thêm thuộc tính gz để gán giá trị max
                    if (element['attr']['gz'] !== undefined) {
                        $(selector).attr('gz', element['attr']['gz']);
                    }
                    if (element['attr']['type-err'] !== undefined) {
                        $(selector).attr('type-err', element['attr']['type-err']);
                    }
                    if (element['attr']['no-first-focus'] !== undefined) {
                        $(selector).attr('no-first-focus', element['attr']['no-first-focus']);
                    }
                    // thêm thuộc tính noname để ko rename lại item theo id hoặc class
                    if (!element['attr']['noname']) {
                       if ($(selector).length > 0) {
                           $(selector).attr('name', key);
                       }
                    }
                }
            });
            if (StringModule.IsNullOrEmpty($(firstElement).attr('no-first-focus'))) {
                $(firstElement).first().focus();
            }
        } catch (e) {
            console.log('InitItem: ' + e.message);
        }
    };

    /**
     * Lấy dữ liệu nhập vào từ màn hình theo danh sách các item truyền vào
     *
     * Author :
 - 2018/07/07 - create
     * @param {...Object<string, ItemHtml>} obj Đối tượng các item liên kết với các item trên màn hình
     * @return {Object<string, any>} Dữ liệu theo đối tượng truyền vào
     */
    var GetData = function (obj) {
        try {
            var data = {};
            // Duyệt qua từng item
            $.each(obj, function (key, element) {
                // Get dữ liệu theo CKEditor
                try {
                    if (element['type'] === 'CKEditor' || element['attr']['isCKEditor']) {
                        data[key] = CKEDITOR.instances[key].getData();
                    }
                } catch (ex) {
                    console.log('getDataCkeditor: ' + ex.message);
                }
                // Nếu ko phải CKEditor thì get theo đối tượng bình thường
                var selector = '#' + key;
                if (element['attr']['isClass'] === true) {
                    selector = '.' + key;
                }
                // Lấy dữ liệu kiểu input
                if (element['type'] === 'text' || element['type'] === 'tel' || element['type'] === 'textarea' || element['type'] === 'password' || element['type'] === 'select') {
                    data[key] = $(selector).val();
                    if ($(selector).hasClass('numeric') || $(selector).hasClass('decimal')) {
                        data[key] = data[key].replace(/\./g, '').replace(/,/g, '.')
                    }
                }
                // Lấy dữ liệu kiểu checkbox
                if (element['type'] === 'checkbox') {
                    if ($(selector).is(':checked')) {
                        data[key] = true;
                    }
                    else {
                        data[key] = false;
                    }
                }
                // Lấy dữ liệu kiểu radiobox
                if (element['type'] === 'radio') {
                    $('input[name=' + element['attr']['name'] + ']').each(function () {
                        if ($(this).is(':checked')) {
                            data[key] = $(this).val();
                        }
                    });
                }
                // Lấy dữ liệu kiểu list checkbox
                if (element['type'] === 'listcheckbox') {
                    data[key] = [];
                    $('input[name=' + element['attr']['name'] + ']').each(function () {
                        if ($(this).is(':checked')) {
                            data[key].push($(this).val());
                        }
                    });
                }
            });
            return data;
        }
        catch (e) {
            console.log('GetData: ' + e.message);
            return {};
        }
    };

    /**
     * Tạo icon loading che hết màn hình khi sử dụng ajax
     *
     * Author :
 - 2018/07/07 - create
     */
    var CallLoading = function () {
        try {
            // Nếu đã có icon thì không tạo nữa
            if ($('#call-ajax-content').length > 0 || DISABLE_LOADING) {
                return;
            }
            /** Ảnh loading */
            var imgLoading = 'https://cdn.shopify.com/s/files/1/2159/5497/t/8/assets/Preloader_2.gif?v=101769009089639459851660720162';
            /** Nội dung màn loading */
            var htmlLoading = '<div id="call-ajax-fade">' +
                '</div>' +
                '<div id="call-ajax-content">' +
                '<img src="' + imgLoading + '" class="img-loading-ajax" alt="loading" />' +
                '</div>';
            // Thêm màn loading vào màn hình
            if ($('#import-progessbar').length > 0) {
                $(htmlLoading).insertBefore($('#import-progessbar'));
            }
            else {
                $('body').append(htmlLoading);
            }
            // Thêm css để hiển thị che hết toàn bộ màn hình
            $("#call-ajax-fade").css({
                'position': 'fixed',
                'top': '0px',
                'left': '0px',
                'width': '100%',
                'height': '100%',
                'background': '#fff',
                'opacity': '0.8',
                'z-index': '99999999999999999999'
            });
            $("#call-ajax-content").css({
                'position': 'fixed',
                'top': '0px',
                'left': '0px',
                'width': '100%',
                'height': '100%',
                'background': 'transparent',
                'opacity': '1',
                'z-index': '99999999999999999999'
            });
            $("#call-ajax-content .img-loading-ajax").css({
                'display': 'block',
                'position': 'absolute',
                'top': 'calc(50% - 50px)',
                'left': 'calc(50% - 50px)',
                'width': '100px',
                'height': '100px',
                'opacity': '1'
            });
        } catch (e) {
            console.log('CallLoading: ' + e.message);
        }
    };

    /**
     * Xóa màn loading để có thể tương tác tiếp
     *
     * Author :
 - 2018/07/07 - create
     */
    var CloseLoading = function () {
        try {
            // Xóa các item che màn hình đi
            $('#call-ajax-fade').remove();
            $('#call-ajax-content').remove();
        } catch (e) {
            console.log('CloseLoading: ' + e.message);
        }
    };

    /**
     * Lấy phần tử cuối cùng của 1 URL
     *
     * Author :
 - 2018/07/07 - create
     * @param {string} url Đường dẫn cần lấy phần tử cuối cùng
     * @return {string} Giá trị phần tử cuối cùng của đường dẫn
     */
    var GetLastOfUrl = function (url) {
        try {
            var url_arr = url.split('/');
            return url_arr[url_arr.length - 1];
        }
        catch (e) {
            console.log('GetLastOfUrl: ' + e.message);
            return '';
        }
    };

    /**
     * Tạo query string gắn trên đường dẫn từ 1 đối tượng data
     *
     * Author :
 - 2018/07/07 - create
     * @param {...Object<string,string|number|boolean>} obj Đối tượng cần đưa lên đường dẫn
     * @return {string} Chuỗi query string để đưa giá trị lên đường dẫn
     */
    var Serialize = function (obj) {
        try {
            var str = [];
            for (var p in obj)
                if (obj.hasOwnProperty(p)) {
                    str.push(encodeURIComponent(p) + "=" + encodeURIComponent(obj[p]));
                }
            return str.join("&");
        }
        catch (e) {
            console.log('Serialize: ' + e.message);
            return '';
        }
    };

    /**
     * Thay đổi đường link trên trình duyệt để lưu lịch sử mà không cần load lại trang
     *
     * Author :
 - 2018/07/07 - create
     * @param {string} page Tên trang của đường dẫn sẽ upadte
     * @param {string} url Đường dẫn sẽ update lên trình duyệt
     */
    var ChangeUrl = function (page, url) {
        try {
            if (typeof (history.pushState) !== "undefined") {
                var obj = { Page: page, Url: url };
                history.pushState(obj, obj.Page, obj.Url);
            }
            else {
                console.log("Browser does not support HTML5.");
            }
        }
        catch (e) {
            console.log('ChangeUrl: ' + e.message);
        }
    };

    /**
     * Trở về trang list với trạng thái như lúc trước từ trang master
     *
     * Author :
 - 2018/07/07 - create
     * @param {string} key Tên trang đã lưu lại trong local store
     * @param {string} defaultLink Nếu tìm ko có thì sẽ dùng link mặc định này
     */
    var BackToList = function (key, defaultLink) {
        try {
            if (window.localStorage.getItem(key)) {
                window.location = window.localStorage.getItem(key);
            }
            else {
                window.location = defaultLink;
            }
        }
        catch (e) {
            console.log('BackToList: ' + e.message);
        }
    };

    /**
     * Hàm sử lý chung sau khi lưu một dữ liệu nào đó
     *
     * Author :
 - 2018/07/07 - create
     * @param {ResponseInfo} res Dữ liệu trả về từ server
     * @param {NotifyCallback} [callback] Hàm sẽ thực hiện sau khi người dùng chọn trên thông báo
     * @param {NotifyCallback} [callbackError] Hàm sẽ thực hiện sau khi người dùng chọn trên thông báo lỗi nếu có lỗi
     */
    var SaveSuccess = function (res, callback, callbackError) {
        try {
            // Nếu lưu thành công thì đưa thông báo và yêu cầu xác nhận trang càn điều hướng
            if (res.code === 200) {
                Notification.Alert(MSG_NO.SAVE_DATA_SUCCESS, callback);
            }
            // Nếu bị lỗi validate thì hiển thị thông báo lỗi trên các item
            else if (res.code === 422) {
                ValidateModule.FillError(res.errors.data);
                ValidateModule.FocusFirstError();
            }
            // Nếu có lỗi khác thì hiển thị popup thông báo
            else {
                Notification.Alert(res.msgNo, callbackError);
            }
        }
        catch (e) {
            console.log('SaveSuccess: ' + e.message);
        }
    };

    /**
     * Hàm sử lý chung sau khi xóa một dữ liệu nào đó
     *
     * Author :
 - 2018/07/07 - create
     * @param {ResponseInfo} res Dữ liệu trả về từ server
     * @param {NotifyCallback} [callback] Hàm sẽ thực hiện sau khi người dùng chọn trên thông báo
     * @param {NotifyCallback} [callbackError] Hàm sẽ thực hiện sau khi người dùng chọn trên thông báo lỗi nếu có lỗi
     */
    var DeleteSuccess = function (res, callback, callbackError) {
        try {
            // Nếu xóa thành công thì đưa thông báo và yêu cầu xác nhận trang càn điều hướng
            if (res.code === 200) {
                Notification.Alert(MSG_NO.DELETE_DATA_SUCCESS, callback);
            }
            // Nếu có lỗi thì hiển thị popup thông báo
            else {
                Notification.Alert(res.MsgNo, callbackError);
            }
        }
        catch (e) {
            console.log('DeleteSuccess: ' + e.message);
        }
    };

    /**
     * Đánh tabindex cho các item trên màn hình để có thể sử dụng tab
     *
     * Author :
 - 2018/07/07 - create
     */
    var SetTabindex = function () {
        try {
            $(':input:not([type="hidden"]), a:not([disabled="disabled"]):not([href=""])').each(function (i) {
                if ($(this).hasClass('isCKEditor')) {
                    // Thêm tabindex cho CKEditor
                    setTimeout(function () {
                        $('.cke_editor_' + $(this).attr("id") + ' iframe').attr('tabindex', i + 1);
                    }, 500);
                }
                else {
                    $(this).attr('tabindex', i + 1);
                }
            });
        }
        catch (e) {
            console.log('SetTabindex: ' + e.message);
        }
    };

    /**
     * Đổi chuổi từ tiếng việt có dấu sang không dấu, loại bỏ dấu cách và các ký tự đặc biệt
     *
     * Author :
 - 2018/07/07 - create
     * @param {string} str Chuỗi tiếng việt cần xử lý
     * @return {string} Chuỗi không dấu sau khi đã xử lý
     */
    var ConvertToUnSign = function (str) {
        try {
            var strTemp = str;
            strTemp = strTemp.replace(/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ/g, "a");
            strTemp = strTemp.replace(/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ/g, "e");
            strTemp = strTemp.replace(/ì|í|ị|ỉ|ĩ/g, "i");
            strTemp = strTemp.replace(/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ/g, "o");
            strTemp = strTemp.replace(/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ/g, "u");
            strTemp = strTemp.replace(/ỳ|ý|ỵ|ỷ|ỹ/g, "y");
            strTemp = strTemp.replace(/đ/g, "d");
            strTemp = strTemp.replace(/À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ/g, "A");
            strTemp = strTemp.replace(/È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ/g, "E");
            strTemp = strTemp.replace(/Ì|Í|Ị|Ỉ|Ĩ/g, "I");
            strTemp = strTemp.replace(/Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ/g, "O");
            strTemp = strTemp.replace(/Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ/g, "U");
            strTemp = strTemp.replace(/Ỳ|Ý|Ỵ|Ỷ|Ỹ/g, "Y");
            strTemp = strTemp.replace(/Đ/g, "D");
            strTemp = strTemp.replace(/[^a-zA-Z0-9---]/g, "-");
            strTemp = strTemp.replace(/----/g, "-");
            strTemp = strTemp.replace(/---/g, "-");
            strTemp = strTemp.replace(/--/g, "-");
            strTemp = strTemp.replace(/--/g, "-");
            return strTemp;
        } catch (e) {
            console.log('ConvertToUnSign: ' + e.message);
            return str;
        }
    };

    /**
     * Khóa các chức năng không cho người dùng bật debug và xem source code
     *
     * Author :
 - 2018/07/07 - create
     * @param {boolean} [disableFull=false]
     * true: Khóa tất cả các tương tác
     * false: Chỉ khóa tương tác liên quan đền debug
     */
    var DisableFunction = function (disableFull) {
        try {
            console.log(location.hostname);
            if ((location.hostname === "localhost" || location.hostname === "127.0.0.1" || location.hostname === "ljshop.net")) {
                // Mặc định chỉ khóa debug
                if (StringModule.IsNullOrEmpty(disableFull)) {
                    disableFull = false;
                }
                $(document).keydown(function (event) {
                    if (
                        (
                            disableFull && (
                                (
                                    event.ctrlKey === true && (
                                           event.which === 82 // Ctrl + R
                                        || event.which === 83 // Ctrl + S
                                        || event.which === 80 // Ctrl + P
                                        || event.which === 85 // Ctrl + U
                                        || event.which === 116 // Ctrl + F5
                                        //|| event.which === 67 // Ctrl + C
                                        //|| event.which === 86 // Ctrl + V
                                    )
                                )
                                || (
                                    event.ctrlKey === true
                                    && event.shiftKey === true
                                    && event.which === 73
                                ) // Ctrl + Shift + I
                                || (
                                    event.altKey === true && (
                                        event.which === 37 // Alt +　←
                                        || event.which === 39 // Alt + →
                                        || event.which === 9 // Alt + Tab
                                    )
                                )
                                || event.which === 44 // Print Screen
                                || event.which === 116 // F5
                            )
                        )
                        || (
                            !disableFull && (
                                (
                                    event.ctrlKey === true
                                    && event.shiftKey === true
                                    && event.which === 73
                                ) // Ctrl + Shift + I
                                || (
                                    event.ctrlKey === true
                                    && event.which === 85 // Ctrl + U
                                )
                                || (
                                    event.ctrlKey === true
                                    && event.which === 83 // Ctrl + S
                                )
                            )
                        )
                    ) {
                        event.preventDefault();
                    }
                });
                // Không cho click chuột phải
                document.oncontextmenu = document.body.oncontextmenu = function () { return false; };
            }
        }
        catch (e) {
            console.log('DisableFunction: ' + e.message);
        }
    };

    /**
     * Lấy IP local (private IP) của máy user đang tương tác
     *
     * Author :
 - 2018/07/07 - create
     * @param {CallbackAfterHaveIP} [callback] Hàm thực hiện sau khi có được IP
     * @return {string} private IP đã lấy được
     */
    var GetLanIp = function (callback) {
        try {
            window.RTCPeerConnection = window.RTCPeerConnection || window.mozRTCPeerConnection || window.webkitRTCPeerConnection;   //compatibility for firefox and chrome
            var pc = new RTCPeerConnection({ iceServers: [] }), noop = function () { };
            pc.createDataChannel("");    //create a bogus data channel
            pc.createOffer(pc.setLocalDescription.bind(pc), noop);    // create offer and set local description
            pc.onicecandidate = function (ice) {  //listen for candidate events
                if (!ice || !ice.candidate || !ice.candidate.candidate) return;
                var myIP = /([0-9]{1,3}(\.[0-9]{1,3}){3}|[a-f0-9]{1,4}(:[a-f0-9]{1,4}){7})/.exec(ice.candidate.candidate);
                if (myIP !== null) {
                    myIP = myIP[1];
                }
                else {
                    myIP = '';
                }
                pc.onicecandidate = noop;
                if (callback) {
                    callback(myIP);
                }
                return myIP;
            };
        }
        catch (e) {
            console.log('GetLanIp: ' + e.message);
            if (callback) {
                callback('');
            }
            return '';
        }
    };

    /**
     * Kiểm tra thiết bị đang dùng có phải là mobile hay không
     *
     * Author :
 - 2018/07/07 - create
     * @return {boolean}
     * true: Nếu người dùng đang sử dụng mobile
     * flase: Nếu người dùng đang sử dụng máy tính
     */
    var IsMobile = function () {
        try {
            if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
                return true;
            }
        }
        catch (e) {
            console.log('IsMobile: ' + e.message);
        }
        return false;
    };

    /**
     * So sánh 2 dữ liệu có bằng nhau hay không.
     *
     * Author :
 - 2018/07/07 - create
     * @param {...Object<string, object>} oldData Dữ liệu cần so sánh
     * @param {...Object<string, object>} newData Dữ liệu dùng để so sánh
     * @return {boolean}
     * true: Nếu bằng nhau
     * flase: Nếu không bằng nhau
     */
    var CompareDataInScreen = function (oldData, newData) {
        try {
            var isEqua = true;
            // Nếu khác kiểu dữ liệu thì không bằng nhau
            if (typeof oldData !== typeof newData) {
                isEqua = false;
            }
            else {
                // Nếu không phải là object thì so sánh thông thường
                if (typeof oldData !== 'object' && oldData !== newData) {
                    isEqua = false;
                }
                // Nếu là object
                else {
                    // Nhưng số lượng thuộc tính không giống nhau thì không bằng nhau
                    if (Object.keys(oldData).length !== Object.keys(newData).length) {
                        isEqua = false;
                    }
                    else {
                        // Nếu trong tất cả các thuộc tính có 1 thuộc tính không bằng nhau thì không bằng nhau
                        $.each(oldData, function (key, element) {
                            if (isEqua) {
                                if (typeof element === 'object') {
                                    if (!CompareDataInScreen(element, newData[key])) {
                                        isEqua = false;
                                    }
                                }
                                else {
                                    if (newData[key] !== element) {
                                        isEqua = false;
                                    }
                                }
                            }
                        });
                    }
                }
            }
            return isEqua;
        }
        catch (e) {
            console.log('CompareDataInScreen: ' + e.message);
            return true;
        }
    };

    /**
     * Lấy đối tượng HTML của 1 option (thẻ option) đang được chọn trong 1 combobox (thẻ select).
     *
     * Author :
 - 2018/07/07 - create
     * @param {object} $select Thẻ select cần tìm thẻ option được chọn
     * @return {object} Thẻ option được chọn
     */
    var GetSelectedOption = function ($select) {
        try {
            return $select.find('option[value="' + $select.val() + '"]');
        }
        catch (e) {
            console.log('GetSelectedOption: ' + e.message);
            return null;
        }
    }

    function UUID() { // Public Domain/MIT
        var d = new Date().getTime();//Timestamp
        var d2 = (performance && performance.now && (performance.now() * 1000)) || 0;//Time in microseconds since page-load or 0 if unsupported
        return 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function (c) {
            var r = Math.random() * 16;//random number between 0 and 16
            if (d > 0) {//Use timestamp until depleted
                r = (d + r) % 16 | 0;
                d = Math.floor(d / 16);
            } else {//Use microseconds since page-load if supported
                r = (d2 + r) % 16 | 0;
                d2 = Math.floor(d2 / 16);
            }
            return (c === 'x' ? r : (r & 0x3 | 0x8)).toString(16);
        });
    }

    return {
        InitEvents: InitEvents,
        InitItem: InitItem,
        CallLoading: CallLoading,
        CloseLoading: CloseLoading,
        GetData: GetData,
        GetLastOfUrl: GetLastOfUrl,
        Serialize: Serialize,
        ChangeUrl: ChangeUrl,
        BackToList: BackToList,
        SaveSuccess: SaveSuccess,
        DeleteSuccess: DeleteSuccess,
        SetTabindex: SetTabindex,
        ConvertToUnSign: ConvertToUnSign,
        DisableFunction: DisableFunction,
        GetLanIp: GetLanIp,
        IsMobile: IsMobile,
        CompareDataInScreen: CompareDataInScreen,
        GetSelectedOption: GetSelectedOption,
        UUID: UUID
    };
})();

/*********************************/
/**      Module Fullscreen       */
/*********************************/

/**
 * Module chứa các xử lý liên quan đến tạo màn hình full screen
 *
 * Author       :
 - 2018/07/07 - create
 *
 * Output       :   FullScreenModule.GoInFullscreen(element) - Làm cho 1 item nào đó full screen
 * Output       :   FullScreenModule.GoOutFullscreen() - Tắt chế độ full screen hiện tại
 * Output       :   FullScreenModule.CurrentFullScreenElement() - Lấy đối tượng hiện tại đang ở chế độ full screen
 * Output       :   FullScreenModule.IsFullScreenCurrently() -  Kiểm tra hiện tại có đang ở chế độ full screen hay không
 * Output       :   FullScreenModule.SetAlwayFullScreen(element) -  Điều chỉnh cho 1 đối tượng luôn ở chế độ full screen
 */
var FullScreenModule = (function () {
    /**
     * Làm cho 1 item nào đó full screen
     *
     * Author :
 - 2018/07/07 - create
     * @param {object} element Đối tượng javascript cần full screen
     */
    var GoInFullscreen = function (element) {
        try {
            if (element.requestFullscreen)
                element.requestFullscreen();
            else if (element.mozRequestFullScreen)
                element.mozRequestFullScreen();
            else if (element.webkitRequestFullscreen)
                element.webkitRequestFullscreen();
            else if (element.msRequestFullscreen)
                element.msRequestFullscreen();
        }
        catch (e) {
            console.log('GoInFullscreen: ' + e.message);
        }
    };

    /**
     * Tắt chế độ full screen hiện tại
     *
     * Author :
 - 2018/07/07 - create
     */
    var GoOutFullscreen = function () {
        try {
            if (document.exitFullscreen)
                document.exitFullscreen();
            else if (document.mozCancelFullScreen)
                document.mozCancelFullScreen();
            else if (document.webkitExitFullscreen)
                document.webkitExitFullscreen();
            else if (document.msExitFullscreen)
                document.msExitFullscreen();
        }
        catch (e) {
            console.log('GoOutFullscreen: ' + e.message);
        }
    };

    /**
     * Lấy đối tượng hiện tại đang ở chế độ full screen
     *
     * Author :
 - 2018/07/07 - create
     * @return {object} Đối tượng javascript của item đang full screen
     */
    var CurrentFullScreenElement = function () {
        try {
            return (document.fullscreenElement || document.webkitFullscreenElement || document.mozFullScreenElement || document.msFullscreenElement || null);
        }
        catch (e) {
            console.log('CurrentFullScreenElement: ' + e.message);
            return null;
        }
    };

    /**
     * Kiểm tra hiện tại có đang ở chế độ full screen hay không
     *
     * Author :
 - 2018/07/07 - create
     * @return {boolean} true nếu có bất kì đối tượng nào đó đang full screen, và false nếu ngược lại
     */
    var IsFullScreenCurrently = function () {
        try {
            // Lấy đối tượng đang full screen
            var full_screen_element = CurrentFullScreenElement();
            // Nếu có tồn tại thì màn hình đang full screen, ngược lại thì không
            if (full_screen_element === null)
                return false;
            else
                return true;
        }
        catch (e) {
            console.log('IsFullScreenCurrently: ' + e.message);
            return false;
        }
    };

    /**
     * Điều chỉnh cho 1 đối tượng luôn ở chế độ full screen
     * bằng cách bật lại chế độ full screen nếu bị người dùng tắt
     *
     * Author :
 - 2018/07/07 - create
     * @param {object} element đối tượng javascript cần full screen
     */
    var SetAlwayFullScreen = function (element) {
        try {
            $(document).on('fullscreenchange webkitfullscreenchange mozfullscreenchange MSFullscreenChange', function () {
                if (!FullScreenModule.IsFullScreenCurrently()) {
                    FullScreenModule.GoInFullscreen(element);
                }
            });
        }
        catch (e) {
            console.log('SetAlwayFullScreen: ' + e.message);
        }
    };

    return {
        GoInFullscreen: GoInFullscreen,
        GoOutFullscreen: GoOutFullscreen,
        CurrentFullScreenElement: CurrentFullScreenElement,
        IsFullScreenCurrently: IsFullScreenCurrently,
        SetAlwayFullScreen: SetAlwayFullScreen
    };
})();
