<div class="flex items-center bg-gray-100 dark:bg-gray-900">
    <div class="container max-w-6xl px-5 mx-auto my-5">
        <div class="grid gap-7 sm:grid-cols-2 lg:grid-cols-4">
            <x-admin-card :icon_class="'bi bi-people-fill'"
                          :title="__('Customer Save')" :qty="$customer_count"/>

            <x-admin-card :icon_class="'bi bi-cash'"
                          :title="__('Deposit - Today')" :qty="$sumDepositByDay.' HTG'"/>

            <x-admin-card :icon_class="'bi bi-cash'"
                          :title="__('Deposit - Month')" :qty="$sumDepositByMonth.' HTG'"/>

            <x-admin-card :icon_class="'bi bi-cash-stack'"
                          :title="__('Withdrawal - Today')" :qty="$sumWithdrawByDay.' HTG'"/>
        </div>
    </div>
</div>
