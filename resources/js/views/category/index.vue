<template>
  <div class="app-container">

    <el-table
      :key="tableKey"
      v-loading="listLoading"
      :data="list"
      border
      fit
      highlight-current-row
      style="width: 100%;"
    >
      <el-table-column :label="$t('table.id')" prop="id" sortable="custom" align="center" width="80">
        <template slot-scope="scope">
          <span>{{ scope.row.id }}</span>
        </template>
      </el-table-column>
      <el-table-column label="一级分类名称" width="150px" align="center">
        <template slot-scope="scope">
          <span>{{ oneCategoryList[scope.row.pid].name }}</span>
        </template>
      </el-table-column>
      <el-table-column label="二级级分类名称" width="120px" align="center">
        <template slot-scope="scope">
          <span>{{ scope.row.name }}</span>
        </template>
      </el-table-column>
      <el-table-column label="二级级分类图标" width="120px" align="center">
        <template slot-scope="scope">
          <img :src="scope.row.img" class="user-avatar">
        </template>
      </el-table-column>
      <el-table-column :label="$t('table.actions')" align="center" width="230" class-name="small-padding fixed-width">
        <template slot-scope="{row}">
          <router-link :to="'/category/edit/' + row.id">
            <el-button type="primary" size="small" icon="el-icon-edit">
              {{ $t('table.edit') }}
            </el-button>
          </router-link>
          <router-link :to="{path: '/audio/audio', query: {category_id: row.id }}">
            <el-button type="primary" size="small">
              查看音频
            </el-button>
          </router-link>
        </template>
      </el-table-column>
    </el-table>
  </div>
</template>

<script>
import { fetchList } from '@/api/category';

export default {
  name: 'Index',
  data() {
    return {
      tableKey: 0,
      list: null,
      oneCategoryList: null,
      total: 0,
      listLoading: true,
      showReviewer: false,
    };
  },
  created() {
    this.getList();
  },
  methods: {
    async getList() {
      this.listLoading = true;
      const { one_category_list, two_category_list } = await fetchList();
      this.list = two_category_list;
      this.oneCategoryList = one_category_list;

      // Just to simulate the time of the request
      this.listLoading = false;
    },
  },
};
</script>
