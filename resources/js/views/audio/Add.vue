<!--suppress HtmlUnknownTarget -->
<template>
  <div class="app-container">
    <el-form ref="form" :model="form" label-width="120px">
      <el-form-item label="音乐分组">
        <el-select v-model="form.type" placeholder="请选择分组" clearable class="filter-item" style="width: 130px" @change="aaa">
          <el-option v-for="item in groupList" :key="item.id" :label="item.name" :value="item.id" />
        </el-select>
      </el-form-item>
      <el-form-item label="标题">
        <el-input v-model="form.title" placeholder="标题" style="width: 200px;" class="filter-item" />
      </el-form-item>
      <el-form-item label="文稿">
        <el-input v-model="form.description" type="textarea" placeholder="文稿" style="width: 200px;" class="filter-item" />
      </el-form-item>
      <el-form-item label="搜索关键词">
        <el-input v-model="form.search_content" placeholder="搜索关键词" style="width: 200px;" class="filter-item" />
      </el-form-item>
      <el-form-item label="语言">
        <el-select v-model="form.language_id" placeholder="请选择语言" clearable class="filter-item" style="width: 130px">
          <el-option v-for="item in languageList" :key="item.id" :label="item.name" :value="item.id" />
        </el-select>
      </el-form-item>
      <el-form-item v-if="isShowRemindDate" label="请填写天数">
        <el-input-number v-model="form.remind_date" controls-position="right" :min="1" :max="300" />
      </el-form-item>
      <el-form-item v-if="isShowSort" label="排序">
        <el-input-number v-model="form.sort" controls-position="right" :min="0" :max="300" />
      </el-form-item>
      <el-form-item v-if="isShowSort" label="音乐分类">
        <el-cascader
          v-model="categoryValue"
          placeholder="请选择分类"
          :options="categoryList"
          filterable
          clearable
          class="filter-item"
          @change="handleChange"
        />
      </el-form-item>
      <el-form-item label="音频文件">
        <el-upload
          action="api/admin/file/upload"
          accept=".mp3"
          :limit="1"
          :before-upload="beforeUploadFile"
          :on-success="handleAvatarSuccess"
        >
          <el-button size="small" type="primary">点击上传</el-button>
        </el-upload>
      </el-form-item>
      <audio id="audio_url" :src="audioUrl" />
      <el-button
        style="margin-left: 10px;"
        type="primary"
        @click="submitForm"
      >
        提交
      </el-button>
    </el-form>
  </div>
</template>

<script>
import { fetchList as languageList } from '@/api/language';
import { fetchList as categoryList } from '@/api/category';
import { insertData } from '@/api/audio';
import router from '@/router';

export default {
  name: 'Add',
  data() {
    return {
      categoryValue: undefined,
      categoryList: [],
      audioUrl: undefined,
      isShowRemindDate: false,
      isShowSort: false,
      languageList: [],
      groupList: [{ name: '每日2分钟提醒', id: 0 }, { name: '五分钟小专题', id: 1 }],
      oneCategoryName: '',
      imageUrl: '',
      oneCategoryList: [],
      form: {
        title: undefined,
        search_content: undefined,
        duration: undefined,
        audio_path: undefined,
        type: 0,
        remind_date: null,
        language_id: 1,
        category_id: 0,
        sort: 0,
        description: null,
      },
    };
  },
  created() {
    this.isShowRemindDate = this.form.type === 0;
    this.isShowSort = this.form.type !== 0;
    this.getLanguageList();
    this.getCategory();
  },
  methods: {
    handleChange(val) {
      this.form.category_id = val[1];
      console.log(val);
    },
    async getCategory() {
      var query = { edit: 1 };
      const { one_category_list, two_category_list } = await categoryList(query);
      for (var i = 0; i < one_category_list.length; i++) {
        this.categoryList.push({ value: one_category_list[i].id, label: one_category_list[i].name, children: [] });
        for (var a = 0; a < two_category_list.length; a++) {
          if (one_category_list[i].id === two_category_list[a].pid) {
            this.categoryList[i].children.push({ value: two_category_list[a].id, label: two_category_list[a].name });
          }
        }
      }
      console.log('12');
      console.log(this.categoryList);
      console.log(two_category_list);
    },
    duration() {
      var audio = document.getElementById('audio_url');
      if (audio.readyState > 0) {
        var minutes = parseInt(audio.duration / 60, 10);
        var seconds = parseInt(audio.duration % 60);

        return (minutes + ':' + seconds);
      }
    },
    beforeUploadFile() {

    },
    handleAvatarSuccess(response, res, file) {
    // this.imageUrl = URL.createObjectURL(res.raw);
      this.audioUrl = response;
      this.form.audio_path = response;
      console.log(response);
      this.duration();
    },
    aaa(val) {
      console.log(val);
      this.isShowRemindDate = val === 0;
      this.isShowSort = val !== 0;
    },
    async getLanguageList() {
      this.listLoading = true;
      const { data } = await languageList();
      console.log(data);
      this.languageList = data;

      // Just to simulate the time of the request
      this.listLoading = false;
    },

    beforeAvatarUpload(file) {
      const isJPG = file.type === 'image/jpeg';
      const isPNG = file.type === 'image/png';
      const isLt2M = file.size / 1024 / 1024 < 2;

      if (!(isPNG || isJPG)) {
        this.$message.error('上传头像图片只能是 JPG 或者 PNG 格式!');
      }
      if (!isLt2M) {
        this.$message.error('上传头像图片大小不能超过 2MB!');
      }
      return isJPG && isLt2M;
    },
    submitForm() {
      this.form.audio_duration = this.duration();
      insertData(this.form).then((response) => {
        this.dialogFormVisible = false;
        console.log(response);
        if (response.code === 1) {
          this.$notify({
            title: '该天提醒已经上传',
            message: '该天提醒已经上传',
            type: 'fail',
            duration: 2000,
          });
        } else if (response.code === 500) {
          this.$notify({
            title: '失败',
            message: '操作失败',
            type: 'fail',
            duration: 2000,
          });
        } else {
          this.$notify({
            title: 'Success',
            message: '成功',
            type: 'success',
            duration: 2000,
          });
        }
        router.push('/audio/audio');
      });

      console.log(this.form);
    },
    onCancel() {
      this.$message({
        message: 'cancel!',
        type: 'warning',
      });
    },
  },
};
</script>
