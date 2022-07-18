<el-select v-model="query.role" :placeholder="$t('table.role')" clearable style="width: 90px" class="filter-item" @change="handleFilter">
  <el-option v-for="item in roles" :key="item" :label="item | uppercaseFirst" :value="item" />
</el-select>
